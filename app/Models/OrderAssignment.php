<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class OrderAssignment extends Model
{
    use SoftDeletes;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $guarded = ['id'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by_id');
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class, 'current_order_status_id');
    }

    public function task()
    {
        return $this->hasOne(Task::class, 'order_assignment_id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function userAccount()
    {
        return $this->hasOne(UserAccount::class, 'user_id');
    }

    public function orderAssignmentActivity()
    {
        return $this->hasMany(OrderAssignmentActivity::class, 'order_assignment_id');
    }
}
