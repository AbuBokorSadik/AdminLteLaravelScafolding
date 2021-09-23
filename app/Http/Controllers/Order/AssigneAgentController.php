<?php

namespace App\Http\Controllers\Order;

use App\Constant\OrderStatusTypeConst;
use App\Http\Controllers\Controller;
use App\Models\OrderAssignment;
use App\Models\OrderAssignmentActivity;
use App\Models\Task;
use App\Models\TaskStatusActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AssigneAgentController extends Controller
{
    public function assigneAgent(Request $request)
    {
        try {
            $orderAssignment = OrderAssignment::where('id', $request->orderAssignmentId)
                ->with('order')
                ->first();

            // echo "<pre>";
            // print_r($orderAssignment->toArray());
            // exit();

            DB::transaction(function () use ($request, $orderAssignment) {
                $orderAssignment->current_order_status_id = OrderStatusTypeConst::ASSIGNED;
                $orderAssignment->save();

                OrderAssignmentActivity::createActivity($orderAssignment, $orderAssignment->current_order_status_id);

                $task_id = Task::createTask($orderAssignment, $request->agentId);

                TaskStatusActivity::createActivity($task_id, $orderAssignment->current_order_status_id);
            });

            $request->session()->flash('success_alert', 'Task Created Successfully.');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }
}
