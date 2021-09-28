<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderStatus;
use App\Models\Task;
use App\Models\TaskStatusActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Task List';
        $task_list_active = 'active';
        try {
            $tasks = Task::where('created_by_id', auth()->user()->id)
                ->with(['orderAssignment.order.orderType', 'assignedTo', 'status'])
                ->filterByTaskID($request)
                ->filterByOrderID($request)
                ->filterByContactName($request)
                ->filterByContactEmail($request)
                ->filterByContactMobile($request)
                ->filterByOrderType($request)
                // ->filterByCreatedAtDateRange($request)
                // ->filterByDeadlineDateRange($request)
                ->orderBy('id', 'DESC')
                ->paginate(20);

            $orderStatuses = OrderStatus::pluck('status', 'id');

            // echo '<pre>';
            // print_r($tasks->toArray());
            // exit();

            $request->flash();

            return view('admin.pages.task.taskList', compact('title', 'task_list_active', 'tasks', 'orderStatuses'));
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $title = 'Task Details';

        try {
            $task = Task::where('id', $id)
                ->with(['orderAssignment.order.orderType', 'assignedTo', 'status'])
                ->first();

            $taskStatusActivities = TaskStatusActivity::where('task_id', $task->id)
                ->with(['createdBy', 'taskStatus'])
                ->orderBy('id', 'DESC')
                ->paginate(15);

            $products = OrderProduct::with(['product'])
                ->where('order_id', $task->orderAssignment->order->id)
                ->paginate(15);

            // echo '<pre>';
            // print_r($task->toArray());
            // exit();

            return view('admin.pages.task.taskShow', compact('title', 'task', 'products', 'taskStatusActivities'));
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
    public function edit(Request $request, $id)
    {
        $title = 'Task Update';
        try {
            $task = Task::where('id', $id)
                ->first();

            // echo '<pre>';
            // print_r($task->toArray());
            // exit();

            return view('admin.pages.task.taskUpdate', compact('title', 'task'));
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->back();
        }
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
        // echo '<pre>';
        // print_r($request->all());
        // exit();

        try {
            DB::transaction(function () use ($request, $id) {
                $task = Task::where('id', $id)
                    ->has('orderAssignment.order')
                    ->with(['orderAssignment.order'])
                    ->first();

                // echo '<pre>';
                // print_r($task->toArray());
                // exit();

                if (!$task) {
                    $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
                    return redirect()->back();
                }

                $task->ref_id = $request->ref_id;
                $task->deadline = date('Y-m-d H:i:s', strtotime($request->deadline));
                $task->contact_email = $request->contact_email;
                $task->contact_mobile = $request->contact_mobile;
                $task->contact_address = $request->contact_address;
                $task->instruction = $request->instruction;
                $task->note = $request->note;
                $task->save();

                $order = $task->orderAssignment->order;
                $order->ref_id = $task->ref_id;
                $order->deadline = date('Y-m-d H:i:s', strtotime($request->deadline));
                $order->contact_email = $task->contact_email;
                $order->contact_mobile = $task->contact_mobile;
                $order->address = $task->contact_address;
                $order->instruction = $task->instruction;
                $order->note = $task->note;
                $order->save();
            });

            $request->session()->flash('success_alert', 'Task Updated Successfully.');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->route('tasks.index');
        }
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
