<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $table = "admins";
    protected $guarded = "admin";
    public $timestamp = false ;
    protected $fillable = ['fisrt_name','last_name','email','password'];
    protected $hidden = ['password'];
    
}
