<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'phone_number',
        'password',
        'user_address',
        'ward_code'
    ];
    protected $table = "users";
    protected $guarded = "user";
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
