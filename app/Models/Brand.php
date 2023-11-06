<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Brand extends Model
{
    use HasFactory;
    protected $fillable =['id','brand_name'];
    static function updateProcess($id,$brand_name){
        return DB::table('brands')
        ->where('id',$id)->update([
            'brand_name'=>$brand_name
        ]);
    }
}
