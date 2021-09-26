<?php

namespace App\Http\Controllers\AgentPanel\Task;

use App\Http\Controllers\Controller;
use App\Models\OrderStatus;
use App\Models\Task;
use Illuminate\Http\Request;
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
        try {
            $tasks = Task::where('assigned_id', auth()->user()->id)
                ->with(['orderAssignment.order.orderType', 'assignedBy', 'status'])
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
            // print_r($request->all());
            // exit();

            $request->flash();

            return view('admin.pages.agentPanel.task.taskList', compact('title', 'tasks', 'orderStatuses'));
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
    public function show($id)
    {
        //
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
