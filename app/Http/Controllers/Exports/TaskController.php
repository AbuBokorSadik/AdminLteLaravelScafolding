<?php

namespace App\Http\Controllers\Exports;

use App\Exports\AdminPanel\TaskExport;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Task;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TaskController extends Controller
{
    public function export(Request $request, $task_ids)
    {
        if (!json_decode($task_ids)) {
            $request->session()->flash('error_alert', 'Something went wrong. Please try again later.');
            return redirect()->back();
        }
        $tasks = Task::whereIn('id', json_decode($task_ids))
            ->with(['orderAssignment.order.orderType', 'assignedTo', 'status'])
            ->get();

        // echo '<pre>';
        // print_r($tasks->toArray());
        // exit();
        return Excel::download(new TaskExport($tasks), 'task-sheet.xlsx');
    }
}
