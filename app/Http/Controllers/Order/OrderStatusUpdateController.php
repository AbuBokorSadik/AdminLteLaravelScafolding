<?php

namespace App\Http\Controllers\Order;

use App\Constant\OrderStatusTypeConst;
use App\Http\Controllers\Controller;
use App\Models\OrderAssignment;
use App\Models\OrderAssignmentActivity;
use App\Models\TaskStatusActivity;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderStatusUpdateController extends Controller
{
    public function updateOrderStatus(Request $request)
    {
        $orderAssignment = OrderAssignment::where('id', $request->formOrderAssignmentId)
            ->with(['order', 'task'])
            ->first();

        // echo "<pre>";
        // print_r($request->all());
        // exit();

        if ($orderAssignment->current_order_status_id == OrderStatusTypeConst::CANCELED) {
            $request->session()->flash('error_alert', 'You can not change the status of a canceled order status.');
            return redirect()->back();
        } else if ($orderAssignment->current_order_status_id == OrderStatusTypeConst::SUCCESSFUL) {
            $request->session()->flash('error_alert', 'You can not change the status of a successful order status.');
            return redirect()->back();
        }

        try {
            DB::transaction(function () use ($request, $orderAssignment) {
                $orderAssignment->current_order_status_id = $request->formOrderStatusId;
                $orderAssignment->save();

                OrderAssignmentActivity::createActivity($orderAssignment, $orderAssignment->current_order_status_id);

                if ($orderAssignment->current_order_status_id == OrderStatusTypeConst::RESCHEDULE) {
                    $orderAssignment->order->deadline = date('Y-m-d H:i:s', strtotime($request->deadline));
                    $orderAssignment->order->save();

                    if ($orderAssignment->task) {
                        $orderAssignment->task->current_status_id = $orderAssignment->current_order_status_id;
                        $orderAssignment->task->deadline = date('Y-m-d H:i:s', strtotime($request->deadline));
                        $orderAssignment->task->save();

                        TaskStatusActivity::createActivity($orderAssignment->task->id, $orderAssignment->current_order_status_id);
                    }
                } else if ($orderAssignment->current_order_status_id == OrderStatusTypeConst::SUCCESSFUL) {
                    $orderAssignment->order->collected_amount = $request->collected_amount;
                    $orderAssignment->order->save();

                    if ($orderAssignment->task) {
                        $orderAssignment->task->current_status_id = $orderAssignment->current_order_status_id;
                        $orderAssignment->task->collected_amount = $orderAssignment->order->collected_amount;
                        $orderAssignment->task->save();

                        TaskStatusActivity::createActivity($orderAssignment->task->id, $orderAssignment->current_order_status_id);
                    }
                }
            });

            $request->session()->flash('success_alert', 'Order status updated successfully.');
            return redirect()->back();
        } catch (Exception $e) {
            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }
}
