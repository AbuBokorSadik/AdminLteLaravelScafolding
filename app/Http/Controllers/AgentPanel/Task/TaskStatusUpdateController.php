<?php

namespace App\Http\Controllers\AgentPanel\Task;

use App\Constant\OrderStatusTypeConst;
use App\Http\Controllers\Controller;
use App\Models\OrderAssignment;
use App\Models\OrderAssignmentActivity;
use App\Models\Task;
use App\Models\TaskStatusActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TaskStatusUpdateController extends Controller
{
    public function updateOrderStatus(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // exit();

        $orderAssignment = OrderAssignment::where('id', $request->formOrderAssignmentId)
            ->with(['task'])
            ->first();

        if ($orderAssignment->current_order_status_id == OrderStatusTypeConst::CANCELED) {
            $request->session()->flash('error_alert', 'You can not change the status of a canceled order status.');
            return redirect()->back();
        }

        try {
            DB::transaction(function () use ($request, $orderAssignment) {
                $orderAssignment->current_order_status_id = $request->formOrderStatusId;
                $orderAssignment->save();

                OrderAssignmentActivity::createActivity($orderAssignment, $orderAssignment->current_order_status_id);

                $task = $orderAssignment->task;
                $task->current_status_id =  $orderAssignment->current_order_status_id;
                $task->save();

                TaskStatusActivity::createActivity($task->id, $orderAssignment->current_order_status_id);
            });

            $request->session()->flash('success_alert', 'Task status updated successfully.');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }
}
