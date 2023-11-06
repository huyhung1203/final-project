<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $invoices = Invoice::all();
        return view('invoice.index',compact('invoices'));
    }

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
        $invoice = Invoice::find($id);
        return view('invoice.edit',compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $status = $request->status;
        $adminId = Auth::guard('admin')->user()->id;
        // dd($status,$adminId);
        $rs =Invoice::where('id',$id)->update([
            'invoice_status'=>$status,
            'admin_id'=>$adminId
        ]);
        if($rs==0){
            return redirect('invoice')->with('error','cập nhật trạng thái kkhông thành công');
        }else{
            return redirect('invoice')->with('success','cập nhật trạng thái thành công');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
