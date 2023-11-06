<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable=[
        'total_amount',
        'invoice_status',
        'date_created',
        'receiver_name',
        'receiver_phone',
        'user_id',
        'receiver_address'
    ];
    public function invoice_detail(){
        return $this->hasMany(Invoice_detail::class);
    }
    public $timestamps = false;
    static function createInvoice(
        $user_name, $user_phone, $city, $district, $ward, $user_address,$total,$date
        ){
            return DB::table('invoicés')
            ->insert([
                'total_amount'=>$total,
                'invoice_status'=>1,
                'date_created'=>$date,
                'reveiver_name'=>$user_name,
                'receiver_phone'=>$user_phone,
                'receiver_address'=>$user_address +', '+$ward+', '+$district+', '+$city
            ]);
    }
}
