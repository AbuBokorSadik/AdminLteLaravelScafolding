<?php

namespace App\Models;

use App\Traits\HelperTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Task extends Model
{
    use SoftDeletes, HelperTrait;

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

    public function orderAssignment()
    {
        return $this->belongsTo(OrderAssignment::class, 'order_assignment_id');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_id');
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'current_status_id');
    }

    public function taskStatusActivities()
    {
        return $this->hasMany(TaskStatusActivity::class, 'task_id');
    }

    public function scopeFilterByTaskID($query, Request $request)
    {
        if ($request->filled('task_id')) {
            return $query->where('task_id', $request->task_id);
        }
    }

    public function scopeFilterByOrderID($query, Request $request)
    {
        if ($request->filled('order_id')) {
            return $query->WhereHas('orderAssignment.order', function($query) use($request){
                return $query->where('order_id', $request->order_id);
            });
        }
    }

    public function scopeFilterByContactName($query, Request $request)
    {
        if ($request->filled('contact_name')) {
            return $query->where('contact_name', $request->contact_name);
        }
    }

    public function scopeFilterByContactEmail($query, Request $request)
    {
        if ($request->filled('contact_email')) {
            return $query->where('contact_email', $request->contact_email);
        }
    }

    public function scopeFilterByContactMobile($query, Request $request)
    {
        if ($request->filled('contact_mobile')) {
            return $query->where('contact_mobile', $request->contact_mobile);
        }
    }

    public function scopeFilterByOrderType($query, Request $request)
    {
        if ($request->filled('order_type_id')) {
            return $query->whereHas('orderAssignment.order.orderType', function($query) use($request){
                return $query->where('type_id', $request->order_type_id);
            });
        }
    }

    public function scopeFilterByCreatedAtDateRange($query, Request $request)
    {
        if ($request->filled('createdAtDateRange')) {
            $date = $this->extractDateRange($request->createdAtDateRange);
            return $query->whereBetween('created_at', [$date['date_from'], $date['date_to']]);
        }
    }

    public function scopeFilterByDeadlineDateRange($query, Request $request)
    {
        if ($request->filled('deadlineDateRange')) {
            $date = $this->extractDateRange($request->deadlineDateRange);
            return $query->whereBetween('deadline', [$date['date_from'], $date['date_to']]);
        }
    }
}
