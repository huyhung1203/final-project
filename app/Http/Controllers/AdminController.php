<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\Product_detail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $revenue = Invoice::where('invoice_status', '=', 2)->select(
                DB::raw('DATE_FORMAT(date_created, "%Y-%m") as month'),
                DB::raw('SUM(total_amount) as total')
            )
            ->where('date_created', '>=', Carbon::now()->subMonths(12))
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        $thresholdQuantity = 5;
        $invoice_count = Invoice::where('invoice_status', 2)->count();
        $product_count = Product::join('product_details', 'products.id', '=', 'product_details.product_id')
            ->select('products.product_code', 'products.product_name', 'product_details.product_quantity')
            ->where('product_details.product_quantity', '<=', $thresholdQuantity)
            ->get()->count();
        // dd($invoice_count, $product_count);
        $total = Invoice::where('invoice_status', 2)->orwhere('invoice_status', 2)->sum('total_amount');
        $user = User::all()->count();
        // dd($total);
        return view('admin.index', compact('invoice_count', 'product_count', 'total', 'user', 'revenue'));
    }
    // public function getChartData(){
    //     $revenue = Invoice::
    //     where('invoice_status','=',2)->select(
    //         DB::raw('DATE_FORMAT(date_created, "%Y-%m") as month'),
    //         DB::raw('SUM(total_amount) as total')
    //     )
    //     ->where('date_created', '>=', Carbon::now()->subMonths(12))
    //     ->groupBy('month')
    //     ->orderBy('month')
    //     ->get();
    //     // return view('revenue.index',compact('revenue'));
    //     $labels = ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'];

    //     $votes = [12, 19, 3, 5, 2, 3];

    //     // Trả về dữ liệu dưới dạng JSON  'votes' => $votes,
    //     return response()->json(['labels' => $labels,'revenue'=>$revenue]);
    // }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
