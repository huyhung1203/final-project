<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Repositories\Brand\BrandRepositoryInterface;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    protected $brand;
    function __construct(BrandRepositoryInterface $brand){
        $this->brand = $brand;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $brand = $this->brand->getAll();
        return view('brand.index',compact('brand'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data=$request->all();
        $this->brand->create($data);
        return redirect('brand')->with('success','them moi thanh cong');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $brand = $this->brand->find($id);
        if(!$brand==null){
            return view('brand.edit',compact('brand'));
        }
        else{
            return "khong tim thay ban ghi";
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $brand = $this->brand->find($id);
        if(!$brand==null){
            return view('brand.edit',compact('brand'));
        }
        else{
            return redirect('brand')->with('error','khong tim thay ban ghi');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        //
        // $data=$request->all();
        // dd($data);
        // $this->brand->update($id,$data);
      $brand_name=  $request->input('brand_name');
      $rs = Brand::updateProcess($id,$brand_name);
      if($rs==0){
        return redirect('brand')->with('error','khong the cap nhat');
      } 
      else{
        return redirect('brand')->with('success','cap nhat thanh cong');
      }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $this->brand->delete($id);
        return redirect('brand')->with('success','xoa thanh cong');
    }
}
