<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Repositories\Size\SizeRepositoryInterface;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    protected $size;
    function __construct(SizeRepositoryInterface $size){
        $this->size = $size;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $size = Size::all();
        $size=$this->size->getAll();
        return view('size.index',compact('size'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('size.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data= $request->all();
        $this->size->create($data);
        return redirect('size')->with('success','Them moi thanh cong');
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
        $size=$this->size->find($id);
        if(!$size==null){
            return view('size.edit',compact('size'));
        }
        else{
            return redirect('size')->with('error','khong tim thay ban ghi');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $size_name = $request->input('size_name');
        $rs = Size::updateProcess($id, $size_name);
        if($rs==0){
            return redirect('size')->with('error','khong the cap nhat');
          } 
          else{
            return redirect('size')->with('success','cap nhat thanh cong');
          }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $this->size->delete($id);
        return redirect('size')->with('success','xoa thanh cong');
    }
}
