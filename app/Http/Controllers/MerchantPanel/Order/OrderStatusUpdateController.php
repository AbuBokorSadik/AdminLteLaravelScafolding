<?php

namespace App\Http\Controllers\MerchantPanel\Order;

use App\Constant\OrderStatusTypeConst;
use App\Http\Controllers\Controller;
use App\Models\OrderAssignment;
use App\Models\OrderAssignmentActivity;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderStatusUpdateController extends Controller
{
    public function updateOrderStatus(Request $request)
    {
        echo "<pre>";
        print_r($request->all());
        exit();

        $orderAssignment = OrderAssignment::where('id', $request->formOrderAssignmentId)
            ->first();

        if ($orderAssignment->current_order_status_id != OrderStatusTypeConst::PENDING) {
            $request->session()->flash('error_alert', 'You can cancel only a pending orders.');
            return redirect()->back();
        }

        try {
            DB::transaction(function () use ($request, $orderAssignment) {

                $orderAssignment->current_order_status_id = OrderStatusTypeConst::CANCELED;
                $orderAssignment->save();

                OrderAssignmentActivity::create([
                    'order_assignment_id' => $request->formOrderAssignmentId,
                    'created_by_id' => auth()->user()->id,
                    'status_id' => OrderStatusTypeConst::CANCELED,
                ]);
            });

            $request->session()->flash('success_alert', 'Order cancel successfully.');
            return redirect()->back();
        } catch (Exception $e) {
            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }
}
