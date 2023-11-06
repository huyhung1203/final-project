<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Image extends Model
{
    use HasFactory;
    protected $fillable = ['id','url','product_id'];
   static function getProductImage(){
    return DB::table('images')
    ->join('products','images.product_id','=','products.id')
    ->select(
        'products.*',
        'images.id as id_image',
        'images.url as product_images',
        'images.product_id'
    )
    ->where('images.isThumbnail','=',1)->get();
   }
}
