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

    public function assaignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }

    public function assaignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by_id');
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class, 'current_order_status_id');
    }
}
