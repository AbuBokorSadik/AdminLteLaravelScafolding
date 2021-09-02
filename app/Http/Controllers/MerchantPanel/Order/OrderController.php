<?php

namespace App\Http\Controllers\MerchantPanel\Order;

use App\Constant\StatusTypeConst;
use App\Constant\UserTypeConst;
use App\Http\Controllers\Controller;
use App\Http\Requests\MerchantPanel\Order\OrderStoreRequest;
use App\Models\CompanyTaskOrderType;
use App\Models\Order;
use App\Models\OrderAssignment;
use App\Models\User;
use App\Models\UsersMerchant;
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
            $orders = Order::where('created_by_id', auth()->user()->id)
                ->with(['orderType', 'orderAssaingment.assaignedTo'])
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
            // $sellers = UsersMerchant::where('merchant_id', auth()->user()->id)
            //     ->where('status', StatusTypeConst::ACTIVE)
            //     ->with('user')
            //     ->get();
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
        // print_r(date('Y-m-d', strtotime($request->deadline)));
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
                    'order_type_id' => $request->order_type_id,
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
                    'ref_id' => $request->ref_id,
                    'amount' => $request->amount,
                    'instruction' => $request->instruction,
                    'note' => $request->note,
                ]);
                // if ($request->image) {
                //     $fileName = time() . '_' . $request->image->getClientOriginalName();
                //     $filePath = $request->file('image')->storeAs('order', $fileName, 'public');
                //     $order->image = $filePath;
                //     $order->save();
                // }

                $assignment = OrderAssignment::create([
                    'order_id' => $order->id,
                    'assigned_by_id' => auth()->user()->id,
                    'assigned_to_id' => $request->seller_id,
                    'current_order_status_id' => StatusTypeConst::PENDING,
                    'payment' => StatusTypeConst::DUE,
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
                ->with(['orderType', 'orderAssaingment.orderStatus', 'orderAssaingment.assaignedTo'])
                ->first();

            // echo '<pre>';
            // print_r($order->toArray());
            // exit();

            return view('admin.pages.merchantPanel.order.orderShow', compact('title', 'order'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
