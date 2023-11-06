<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class City extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'type',
        'slug'
    ];
    static function getCitybyID($citycode){
        return DB::table('cities')
        ->select('name as city_name')
        ->where('code',$citycode)
        ->get()->first();
    }
    public function districts()
    {
        return $this->hasMany(District::class, 'city_code', 'code');
    }
}
