<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ward extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'type',
        'slug'
    ];
    static function getWardByDistrict($district){
        return DB::table('wards')
        ->where('district_code', $district)
        ->get();
    }
    public function district()
    {
        return $this->belongsTo(District::class, 'district_code', 'code');
    }
}
