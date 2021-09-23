<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $guarded = ['id'];

    public static function createTask(OrderAssignment $orderAssignment, $agentId)
    {
        $task_unique_id = bin2hex(random_bytes(5));

        while (true) {
            $order = Task::where('task_id', $task_unique_id)->first();
            if (!$order) {
                break;
            }
            $task_unique_id = bin2hex(random_bytes(5));
        }

        $service_charge = $orderAssignment->service_charge + $orderAssignment->area_charge + $orderAssignment->weight_charge + $orderAssignment->delivery_type_charge;

        $task = Task::create([
            'task_id' => $task_unique_id,
            'created_by_id' => auth()->user()->id,
            'assigned_id' => $agentId,
            'order_assignment_id' => $orderAssignment->id,
            'area_id' => $orderAssignment->area_id,
            'current_status_id' => $orderAssignment->current_order_status_id,
            'deadline' => $orderAssignment->order->deadline,
            'instruction' => $orderAssignment->order->instruction,
            'assigned_amount' => $orderAssignment->order->amount,
            'contact_name' => $orderAssignment->order->contact_name,
            'contact_email' => $orderAssignment->order->contact_email,
            'contact_mobile' => $orderAssignment->order->contact_mobile,
            'contact_address' => $orderAssignment->order->address,
            'service_charge' => $service_charge,
            'payment' => $orderAssignment->payment,
            'note' => $orderAssignment->order->note,
        ]);

        return $task->id;
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_id');
    }
}
