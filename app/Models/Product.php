<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','product_code',
        'product_name',
        'product_status',
        'product_description',
        'thumbnail',
        'brand_id',
        'type_id'];
    public function images(){
        return $this->hasMany(Image::class);
    }
    public function product_detail(){
        return $this->hasMany(Product_detail::class);
    }
    static function getPrdNew(){
        return DB::table('products')
        ->join('images', 'products.id','=','images.product_id')
        ->select(
            'products.*',
            'images.id as image_id',
            'images.url as product_image',
            'images.product_id'
        )->get();
    }
}

