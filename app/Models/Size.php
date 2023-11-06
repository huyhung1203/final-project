<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Size extends Model
{
    use HasFactory;
    protected $fillable = ['id','size_name'];
    static function updateProcess($id,$size_name){
        return DB::table('sizes')
        ->where('id',$id)
        ->update([
            'size_name'=>$size_name
        ]);

    }
    public function product_detail(){
        return  $this->hasMany(Product_detail::class);
    }
}
