<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RevenueController extends Controller
{
    //
    public function index(){
        $revenue = Invoice::
        where('invoice_status','=',2)->select(
            DB::raw('DATE_FORMAT(date_created, "%Y-%m") as month'),
            DB::raw('SUM(total_amount) as total')
        )
        ->where('date_created', '>=', Carbon::now()->subMonths(12))
        ->groupBy('month')
        ->orderBy('month')
        ->get();
        return view('revenue.index',compact('revenue'));
    }
    public function detail($month){
        $revenueDetails = Invoice::where('invoice_status','=',2)->select(
            DB::raw('DATE_FORMAT(date_created, "%Y-%m-%d") as month'),
            'total_amount'
        )
        ->whereMonth('date_created', \Carbon\Carbon::parse($month)->month)
        ->whereYear('date_created', \Carbon\Carbon::parse($month)->year)
        ->get();
        // dd($revenueDetails);
        return view('revenue.detail', compact('revenueDetails'));
    }
}
