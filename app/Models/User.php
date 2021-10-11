<?php

namespace App\Models;

use App\Traits\HelperTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HelperTrait;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_type_id',
        'name',
        'email',
        'mobile',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function agents()
    {
        return $this->hasMany(UsersAgent::class);
    }

    public function agentsAdmin()
    {
        return $this->hasOne(UsersAgent::class, 'agent_id');
    }

    public function merchants()
    {
        return $this->hasMany(UsersMerchant::class, 'user_id');
    }

    public function buyers()
    {
        return $this->hasMany(UsersMerchant::class, 'merchant_id');
    }

    public function merchantsAdmin()
    {
        return $this->hasOne(UsersMerchant::class, 'merchant_id');
    }

    public function userType()
    {
        return $this->belongsTo(UserType::class);
    }

    public function areas()
    {
        return $this->hasMany(Area::class, 'created_by_id');
    }

    public function account()
    {
        return $this->hasOne(UserAccount::class, 'user_id');
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

    public function scopeFilterByEmail($query, Request $request)
    {
        if ($request->filled('email')) {
            return $query->where('email', $request->email);
        }
    }

    public function scopeFilterByMobile($query, Request $request)
    {
        if ($request->filled('mobile')) {
            return $query->where('mobile', $request->mobile);
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
            // $cadr = explode(' - ', $request->createdAtDateRange);
            // echo '<pre>';
            // print_r($date);
            // exit();
            return $query->whereBetween('created_at', [$date['date_from'], $date['date_to']]);
        }
    }
}
