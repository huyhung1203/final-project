<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Image;
use App\Models\Invoice_detail;
use App\Models\Product;
use App\Models\Product_detail;
use App\Models\Size;
use App\Repositories\Brand\BrandRepositoryInterface;
use App\Repositories\Color\ColorRepositoryInterface;
use App\Repositories\Picture\ImageRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Size\SizeRepositoryInterface;
use App\Repositories\Type\TypeRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $product,$brand,$type,$size,$color,$image;
    function __construct(
        ProductRepositoryInterface $product,
        BrandRepositoryInterface $brand, 
        TypeRepositoryInterface $type,
        SizeRepositoryInterFace $size,
        ColorRepositoryInterface $color,
        ImageRepositoryInterface $image){
        $this->product = $product;
        $this->brand = $brand;
        $this->type = $type;
        $this->size = $size;
        $this->color = $color;
        $this->image= $image;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $product = $this->product->getAll();
        return view('product.index',compact('product'));
    }
    public function productSold(){
        // Xác định ngưỡng số lượng sắp hết hàng
            $thresholdQuantity = 5;

            // Thực hiện truy vấn
            $products = Product::join('product_details', 'products.id', '=', 'product_details.product_id')
                ->join('sizes','product_details.size_id','=','sizes.id')
                ->join('colors','product_details.color_id','=','colors.id')
                ->select(
                    'products.id',
                    'products.product_code', 
                    'products.product_name', 
                    'products.thumbnail',
                    'product_details.product_quantity',
                    'sizes.size_name',
                    'colors.color_name'
                )
                ->where('product_details.product_quantity', '<=', $thresholdQuantity)
                ->get();
            // dd($products);
            return view('product.product_sold', compact('products'));

            // return view('product.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $brand = $this->brand->getAll();
        $type = $this->type->getAll();
        $color = $this->color->getAll();
        $size = $this->size->getAll();
        return view('product.create',compact('brand', 'type','size','color'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        
       
        // dd($data);
        if($request->has('thumbnail_upload')){
            $thumbNail = $request->thumbnail_upload;
            $thumbNailName = $data['product_name'].'-thumnail-'.time().rand(1,1000).'.'.$thumbNail->extension();
            // dd($thumbNailName);
            $thumbNail->move(public_path('product_images'),$thumbNailName);
        }
        $request->merge(['thumbnail' => $thumbNailName]);
     
       $new_product = $this->product->create($request->all());
       if($request->has('product_image')){
            foreach($request->file('product_image') as $image){
                $imageName = $data['product_name'].'-image-'.time().rand(1,1000).'.'.$image->extension();
                $image->move(public_path('product_images'),$imageName);
                Image::create([
                    'product_id'=>$new_product->id, 
                    'url'=>$imageName
                ]);
            }
       }

        $size = $request->size;
        $color = $request->color;
        $quantity = $request->quantity;
        $price = $request->price;
        $detail_id = $request->product_detail;
        // dd(count($detail_id));
        for($i=0 ;$i<count($detail_id) ; $i++){
            $dataSave =[
                'size_id' => $size[$i],
                'color_id'=> $color[$i],
                'product_id' => $new_product->id,
                'product_quantity'=>$quantity[$i],
                'price'=>$price[$i]
            ];
            // dd($dataSave);
            Product_detail::create($dataSave);
        }
        
   
       return redirect('product')->with('success','them moi thanh cong');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        
    }
    public function showDetail($id){
        $detail = Product_detail::findOrFail($id);
        $color = Color::all();
        $size= Size::all();
        $product=$detail->product;
        // dd($color,$size, $product);
        return view('product.edit_product_detail',compact('color','size','detail'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $data=[
            $brand = $this->brand->getAll();
            $type = $this->type->getAll();
            $color = $this->color->getAll();
            $size = $this->size->getAll();
            $product = $this->product->find($id);
            $images = $product -> images;
            $detail = Product_detail::getPrdDetail($id);
        // ];
        // dd($detail);
        if(!$product == null){
            return view('product.detail',compact('product','brand','type','size','color','images','detail'));
        }
        else{
            return redirect('product')->with('error','khong tim thay ban ghi');
        }
        //
    }
    public function updateDetail($id,$product_id,Request $request){
        $product_id = $request->product_id;
        $color = $request->color;
        $size = $request->size;
        $quantity = $request->quantity;
        $price = $request->price;
        // dd($product_id, $size, $color, $quantity,$price);
        Product_detail::where('id',$id)
        ->where('product_id',$product_id)
        ->update([
            'price' => $price,
            'color_id' => $color,
            'size_id'=>$size,
            'product_quantity'=>$quantity,
        ]);
        return redirect()->back()->with('success','cập nhật thành công');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $product_code = $request->product_code;
        $product_name = $request->product_name;
        $brand_id = $request->brand_id;
        $type_id = $request->type_id;
        $status = $request->status;
        $data=[
            'product_code'=>$product_code,
            'product_name'=>$product_name,
            'brand_id'=>$brand_id,
            'type_id'=>$type_id,
            'product_status'=>$status,
        ];
       
        // dd($data);
        Product::where('id',$id)->update($data);
        return redirect('product')->with('success','cap nha pham thanh cong');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
       
        // $productInInvoice = Invoice_detail::where('product_id', $detailId)->exists();
        try{
            $this->product->delete($id);
         return redirect('product')->with('success','xoa san pham thanh cong');
        }catch(Exception $e){
            return redirect('product')->with('error','sản phẩm đã có người mua không thế xoá');
        }
    }
   
    public function removeImg($id){
        $image = Image::find($id);
        if(!$image) abort(404);
        unlink(public_path('product_images/'.$image->url));
        $image->delete();
        return back()->with('success','Xoa thanh cong');
    }


    public function addImg(Request $request, $id){
        $product = $this->product->find($id);
        if(!$product) abort(404);
        if($request->has('product_image')){
            foreach($request->file('product_image') as $image){
                $imageName = $product['product_name'].'-image-'.time().rand(1,1000).'.'.$image->extension();
                $image->move(public_path('product_images'),$imageName);
                Image::create([
                    'product_id'=>$product->id, 
                    'url'=>$imageName
                ]);
            }
       }
       return redirect('product')->with('success','them anh thanh cong');
    }
}
