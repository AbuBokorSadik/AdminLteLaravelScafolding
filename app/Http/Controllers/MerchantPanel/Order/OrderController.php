<?php

namespace App\Http\Controllers\MerchantPanel\Order;

use App\Constant\OrderStatusTypeConst;
use App\Constant\PaymentStatusTypeConst;
use App\Constant\StatusTypeConst;
use App\Constant\UserTypeConst;
use App\Http\Controllers\Controller;
use App\Http\Requests\MerchantPanel\Order\OrderStoreRequest;
use App\Models\CompanyTaskOrderType;
use App\Models\Order;
use App\Models\OrderAssignment;
use App\Models\OrderAssignmentActivity;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Order List';
        try {
            $orders = Order::wherehas('orderAssignment', function (Builder $query) {
                $query->where('assigned_by_id', auth()->user()->id);
            })
                ->with(['orderType', 'orderAssignment.assignedTo', 'orderAssignment.orderStatus'])
                ->filterByID($request)
                ->filterByOrderID($request)
                ->filterByContactName($request)
                ->filterByContactEmail($request)
                ->filterByContactMobile($request)
                ->filterByContactMobile($request)
                ->filterByOrderType($request)
                ->filterByDeadlineDateRange($request)
                ->filterByCreatedAtDateRange($request)
                ->orderBy('id', 'DESC')
                ->paginate(20);

            // echo '<pre>';
            // print_r($orders->toArray());
            // exit();

            $request->flash();

            return view('admin.pages.merchantPanel.order.orderList', compact('title', 'orders'));
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $title = 'Add Order';
        try {
            $sellers = User::where('user_type_id', UserTypeConst::ADMIN)
                ->whereHas('merchants', function (Builder $query) {
                    $query->where('merchant_id', auth()->user()->id)
                        ->where('status', StatusTypeConst::ACTIVE);
                })
                ->get();

            // echo '<pre>';
            // print_r($sellers->toArray());
            // exit();

            $orderTypes = CompanyTaskOrderType::where('company_id', auth()->user()->id)->pluck('type', 'type_id');
            return view('admin.pages.merchantPanel.order.orderAdd', compact('title', 'orderTypes', 'sellers'));
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderStoreRequest $request)
    {
        // echo '<pre>';
        // print_r($request->all());
        // exit();

        try {
            $order_unique_id = bin2hex(random_bytes(5));
            while (true) {
                $order = Order::where('order_id', $order_unique_id)->first();
                if (!$order) {
                    break;
                }
                $order_unique_id = bin2hex(random_bytes(5));
            }

            DB::transaction(function () use ($request, $order_unique_id) {

                $order = Order::create([
                    'order_id' => $order_unique_id,
                    'created_by_id' => auth()->user()->id,
                    'order_type_id' => $request->order_type,
                    'contact_name' => $request->name,
                    'contact_mobile' => $request->mobile,
                    'contact_email' => $request->email,
                    'address' => $request->address,
                    'address_lat' => $request->address_lat,
                    'address_lng' => $request->address_lng,
                    'product_weight' => $request->product_weight,
                    'product_height' => $request->product_height,
                    'product_length' => $request->product_length,
                    'product_width' => $request->product_width,
                    'deadline' => date('Y-m-d H:i:s', strtotime($request->deadline)),
                    'ref_id' => $request->reference_id,
                    'instruction' => $request->instruction,
                    'note' => $request->note,
                ]);

                $amount = 0;
                if ($request->filled('product_ids')) {
                    for ($i = 0; $i < count($request->product_ids); $i++) {
                        $product = Product::where([
                            'id' => $request->product_ids[$i],
                        ])
                            ->first();

                        $total_uprice = $request->product_quantities[$i] * $product->unit_price;
                        $amount += $total_uprice;
                        $data[$request->product_ids[$i]] = $request->product_quantities[$i];

                        OrderProduct::create([
                            'order_id' => $order->id,
                            'product_id' => $product->id,
                            'measurement_unit' => $product->measurement_unit,
                            'unit_price' => $product->unit_price,
                            'quantity' => $request->product_quantities[$i],
                            'total_price' => $total_uprice,
                        ]);
                    }
                }

                $order->amount = $amount;
                $order->save();

                $order_type = CompanyTaskOrderType::where([
                    'id' => $order->order_type_id,
                ])
                    ->first();

                // echo '<pre>';
                // print_r([gettype($order_type->slab_type),OrderStatusSlabConst::FIXED]);
                // exit();

                if ($order_type->slab_type == 'F') {
                    $service_charge = $order_type->charge;
                } else {
                    $service_charge = ($amount * $order_type->charge) / 100;
                }

                OrderAssignment::create([
                    'order_id' => $order->id,
                    'assigned_by_id' => auth()->user()->id,
                    'assigned_to_id' => $request->seller,
                    'current_order_status_id' => OrderStatusTypeConst::PENDING,
                    'area_id' => $request->area,
                    'service_charge' => $service_charge,
                    'payment' => PaymentStatusTypeConst::DUE,
                ]);
            });

            $request->session()->flash('success_alert', 'Order Created Successfully.');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $title = 'Order Details';
        try {
            $order = Order::where('id', $id)
                ->with(['orderType', 'orderAssignment.orderStatus', 'orderAssignment.assignedBy'])
                ->first();

            $products = OrderProduct::with(['product'])
                ->where('order_id', $id)
                ->paginate(15);

            $orderAssignmentActivities = OrderAssignmentActivity::with(['createdBy', 'orderStatus'])
            ->where('order_assignment_id', $order->orderAssignment->id)
            ->orderBy('id', 'DESC')
            ->paginate(15);

            // echo '<pre>';
            // print_r($products->toArray());
            // exit();

            return view('admin.pages.merchantPanel.order.orderShow', compact('title', 'order', 'products', 'orderAssignmentActivities'));
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
