<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Product extends Model
{
    use SoftDeletes;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilterByID($query, Request $request)
    {
        if ($request->filled('id')) {
            return $query->where('id', $request->id);
        }
    }

    public function scopeFilterByName($query, Request $request)
    {
        if ($request->filled('name')) {
            return $query->where('name', $request->name);
        }
    }

    public function scopeFilterByCategoryID($query, Request $request)
    {
        if ($request->filled('category_id')) {
            return $query->where('category_id', $request->category_id);
        }
    }

    public function scopeFilterByStatus($query, Request $request)
    {
        if ($request->filled('status')) {
            return $query->where('status', $request->status);
        }
    }

    public function scopeFilterByUnitPrice($query, Request $request)
    {
        if ($request->filled('unit_price')) {
            return $query->whereBetween('unit_price', explode(' - ', $request->unit_price));
        }
    }

    public function scopeFilterByCreatedAtDateRange($query, Request $request)
    {
        if ($request->filled('createdAtDateRange')) {
            return $query->whereBetween('created_at', explode(' - ', $request->createdAtDateRange));
        }
    }
}
