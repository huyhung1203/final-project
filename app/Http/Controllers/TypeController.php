<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Repositories\Type\TypeRepositoryInterface;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    protected $type;
    function __construct(TypeRepositoryInterface $type){
        $this->type=$type;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $type=$this->type->getAll();
        return view('type.index',compact('type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data=$request->all();
        $this->type->create($data);
        return redirect('type')->with('success','Them moi thanh cong');
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
        $type=$this->type->find($id);
        return view('type.edit',compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $type_name=$request->input('type_name');
        $rs=Type::updateProcess($id,$type_name);
        if($rs==0){
            return redirect('type')->with('error','Khong The Cap Nhat Ban Ghi');
        }
        else{
            return redirect('type')->with('success',' Cap Nhat Thanh Cong ');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $this->type->delete($id);
        return redirect('type')->with('success','xoa thanh cong');
    }
}
