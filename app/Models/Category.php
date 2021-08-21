<?php

namespace App\Models;

use App\Traits\HelperTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Category extends Model
{
    use SoftDeletes, HelperTrait;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $guarded = ['id'];

    public function products()
    {
        return $this->hasMany(Product::class);
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

    public function scopeFilterByAlias($query, Request $request)
    {
        if ($request->filled('alias')) {
            return $query->where('alias', $request->alias);
        }
    }

    public function scopeFilterByStatus($query, Request $request)
    {
        if ($request->filled('status')) {
            return $query->where('status', $request->status);
        }
    }

    public function scopeFilterByCreatedAtDateRange($query, Request $request)
    {
        if ($request->filled('createdAtDateRange')) {
            $date = $this->extractDateRange($request->createdAtDateRange);
            return $query->whereBetween('created_at', [$date['date_from'], $date['date_to']]);
        }
    }
}
