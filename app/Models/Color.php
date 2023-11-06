<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Color extends Model
{
    use HasFactory;
    protected $fillable=['id','color_name'];
    static function updateProcess($id,$color_name){
        return DB::table('colors')
        ->where('id',$id)
        ->update([
            'color_name'=>$color_name
        ]);
    }
    public function product_detail(){
        return  $this->hasMany(Product_detail::class);
    }
}
