<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Type extends Model
{
    use HasFactory;
    protected $fillable = ['id','type_name'];
    static function updateProcess($id,$type_name){
        return DB::table('types')
        ->where('id',$id)
        ->update([
            'type_name'=>$type_name
        ]);
    }
}
