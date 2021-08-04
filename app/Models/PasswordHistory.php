<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PasswordHistory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'password',
    ];

    protected $table = 'password_histories';
}
