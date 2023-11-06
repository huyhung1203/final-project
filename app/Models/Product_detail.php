<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product_detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'product_quantity',
        'price',
        'product_id',
        'size_id','color_id'];
    
    public function size(){
        return $this->belongsTo(Size::class);
    }
    public function color(){
        return $this -> belongsTo(Color::class);
    }
    public function product(){
        return $this -> belongsTo(Product::class);
    }
    static function getPrdDetail($id){
        return DB::table('product_details')
        ->join('sizes','product_details.size_id','=','sizes.id')
        ->join('colors','product_details.color_id','=','colors.id')
        ->where('product_id',$id)
        ->select(
        'product_details.id as product_detail_id',
        'product_details.price',
        'product_details.product_quantity',
        'product_details.product_id',
        'product_details.size_id',
        'product_details.color_id',
        'sizes.*',
        'colors.*'
        )
        ->get();
    }
    static function getSizeName($id,$color){
        return DB::table('product_details')
        ->join('sizes','product_details.size_id','=','sizes.id')
        ->join('colors','product_details.color_id','=','colors.id')
        ->where('product_details.product_id',$id)
        ->where('product_details.color_id',$color)
        ->select(
        'product_details.id as product_detail_id',
        'product_details.price',
        'product_details.product_quantity',
        'product_details.product_id',
        'product_details.size_id',
        'product_details.color_id',
        'sizes.*',
        'colors.*'
        )
        ->get();
    }
    static function getColor($id)
    {
        $getColorId = DB::table('product_details')
        ->join('colors','product_details.color_id','=','colors.id')
        ->select(
            DB::raw('DISTINCT(product_details.color_id)'),
            'colors.color_name'
        )
        ->where('product_details.product_id',$id);
        return $color = $getColorId->distinct('product_details.color_id')->get();
    }
    static function getSize($id)
    {
        $getSizeId = DB::table('product_details')
        ->join('sizes','product_details.size_id','=','sizes.id')
        ->select(
            DB::raw('DISTINCT(product_details.size_id)'),
            'sizes.size_name'
        )
        ->where('product_details.product_id',$id);
        return $sizes = $getSizeId->distinct('product_details.size_id')->get();
    }
    static function getSizeSlect($id,$color)
    {
        $getSizeId = DB::table('product_details')
        ->join('sizes','product_details.size_id','=','sizes.id')
        ->select(
            DB::raw('DISTINCT(product_details.size_id)'),
            'product_details.product_quantity',
            'sizes.size_name',
           
        )
        ->where('product_details.product_id',$id)
        ->where('product_details.color_id',$color);
        return $sizes = $getSizeId->distinct('product_details.size_id')->get();
    }
    static function getDetailId($id,$color,$size){
        return DB::table('product_details')
        // ->join('colors','product_details.color_id','=','colors.id')
        // ->join('sizes','product_details.size_id','=','sizes.id')
        ->select(
            'product_details.id as detail_id',
            'product_details.price as price',
            'product_details.product_quantity as quantity',
            // 'sizes.*',
            // 'color.*'
        )
        ->where('product_details.product_id',$id)
        ->where('product_details.color_id',$color)
        ->where('product_details.size_id',$size)
        ->get();
    }
    static function getProductAddToCart($detail_id){
        return DB::table('product_details')
        ->join('colors','product_details.color_id','=','colors.id')
        ->join('sizes','product_details.size_id','=','sizes.id')
        ->select(
            'product_details.id as product_detail_id',
            'product_details.price',
            'product_details.product_quantity',
            'product_details.product_id',
            'product_details.size_id',
            'product_details.color_id',
            'sizes.*',
            'colors.*'
        )
        ->where('product_details.id',$detail_id)
        ->get();
        }
        static function deleteDetail($id){
            return DB::table('product_details')
            ->where('id',$id)
            ->delete();
        }
       
}
