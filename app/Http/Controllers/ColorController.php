<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Repositories\Color\ColorRepositoryInterface;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    protected $color;
    function __construct(ColorRepositoryInterface $color){
        $this -> color = $color;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $color = $this -> color->getAll();
        return view('color.index',compact('color'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('color.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        $this->color->create($data);
        return redirect('color')->with('success','them moi thanh cong');
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
        $color = $this->color->find($id);
        if(!$color == null){
            return view('color.edit',compact('color'));
        }
        else{
            return redirect('color')->with('error','khong tim thay ban ghi');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $color_name=  $request->input('color_name');
        $rs = Color::updateProcess($id,$color_name);
        if($rs==0){
            return redirect('color')->with('error','khong the cap nhat');
        } 
        else{
            return redirect('color')->with('success','cap nhat thanh cong');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $this->color->delete($id);
        return redirect('color')->with('success','xoa thanh cong');
    }
    
}
