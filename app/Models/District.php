<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class District extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'type',
        'city_code'
    ];
    static function getDistrictByCity($city){
        return DB::table('districts')
        ->where('city_code','=',$city)
        ->get();
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_code', 'code');
    }
    
    public function wards()
    {
        return $this->hasMany(Ward::class, 'district_code', 'code');
    }
}
