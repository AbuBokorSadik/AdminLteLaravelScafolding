<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderAssignment extends Model
{
    use SoftDeletes;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $guarded = ['id'];

    public function assaignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class, 'current_order_status_id');
    }
}
