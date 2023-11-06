<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Invoice_detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'quantity',
        'invoice_id',
        'product_detail_id'
    ];
    public $timestamps = false;
    static function getHistory($id){
        return DB::table('invoice_details')
        ->join('invoices','invoice_details.invoice_id','=','invoices.id')
        ->join('product_details','invoice_details.product_detail_id','product_details.id')
        ->join('products','product_details.product_id','=','products.id')
        ->join('sizes','product_details.size_id','=','sizes.id')
        ->join('colors','product_details.color_id','=','colors.id')
        ->select(
            'invoices.total_amount',
            'invoices.invoice_status',
            'invoices.date_created',
            'invoice_details.*',
            'sizes.size_name',
            'colors.color_name',
            'product_details.*',
            'products.*'
        )
        ->where('invoice_id',$id)
        ->get();
    }
    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }
}
