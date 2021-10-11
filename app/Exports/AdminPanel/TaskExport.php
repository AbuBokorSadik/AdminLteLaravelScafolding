<?php

namespace App\Exports\AdminPanel;

use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TaskExport implements FromArray, WithHeadings, WithStyles
{
    protected Collection $tasks;

    public function __construct(Collection $tasks)
    {
        $this->tasks = $tasks;
    }

    public function array(): array
    {
        $tasks_info = [];
        $i = 0;
        foreach ($this->tasks as $task) {
            $tasks_info[$i][] = $task->orderAssignment->order->order_id;
            $tasks_info[$i][] = $task->assignedTo->name;
            $tasks_info[$i][] = $task->contact_name;
            $tasks_info[$i][] = $task->contact_email;
            $tasks_info[$i][] = $task->contact_mobile;
            $tasks_info[$i][] = $task->contact_address;
            $tasks_info[$i][] = $task->orderAssignment->order->orderType->type;
            $tasks_info[$i][] = $task->status->status;
            $tasks_info[$i][] = $task->assigned_amount ;
            $tasks_info[$i][] = $task->collected_amount;
            $tasks_info[$i][] = $task->deadline;
            $tasks_info[$i][] = $task->created_at;
            $tasks_info[$i][] = $task->updated_at;
            $i++;
        }
        // echo '<pre>';
        // print_r($this->tasks->toArray());
        // exit();
        return $tasks_info;
    }

    public function headings(): array
    {
        return [
            'Order Id',
            'Assignee',
            'Contact Name',
            'Contact Email',
            'Contact Mobile',
            'Contact Address',
            'Task Type',
            'Task Status',
            'Amount',
            'Collected Amount',
            'Service Charge',
            'Deadline',
            'Created At',
            'Updated At'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('1')->getFont()->setBold(true);
    }
}
