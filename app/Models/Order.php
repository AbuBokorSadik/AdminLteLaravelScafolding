<?php

namespace App\Models;

use App\Traits\HelperTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Order extends Model
{
    use SoftDeletes, HelperTrait;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $guarded = ['id'];

    public function orderType()
    {
        return $this->belongsTo(CompanyTaskOrderType::class);
    }

    public function orderAssignment()
    {
        return $this->hasOne(OrderAssignment::class, 'order_id');
    }

    public function scopeFilterByID($query, Request $request)
    {
        if ($request->filled('id')) {
            return $query->where('id', $request->id);
        }
    }

    public function scopeFilterByOrderID($query, Request $request)
    {
        if ($request->filled('order_id')) {
            return $query->where('order_id', $request->order_id);
        }
    }

    public function scopeFilterByContactName($query, Request $request)
    {
        if ($request->filled('contact_name')) {
            return $query->where('contact_name', $request->name);
        }
    }

    public function scopeFilterByContactEmail($query, Request $request)
    {
        if ($request->filled('contact_email')) {
            return $query->where('contact_email', $request->email);
        }
    }

    public function scopeFilterByContactMobile($query, Request $request)
    {
        if ($request->filled('contact_mobile')) {
            return $query->where('contact_mobile', $request->mobile);
        }
    }

    public function scopeFilterByOrderType($query, Request $request)
    {
        if ($request->filled('order_type_id')) {
            return $query->where('order_type_id', $request->order_type_id);
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
