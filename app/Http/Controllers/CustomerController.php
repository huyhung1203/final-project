<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use App\Models\Image;
use App\Models\Invoice;
use App\Models\Invoice_detail;
use App\Models\Product;
use App\Models\Product_detail;
use App\Models\Size;
use App\Models\User;
use App\Models\Ward;
use App\Repositories\Color\ColorRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    protected $products,$colors;
    function __construct(ProductRepositoryInterface $products,ColorRepositoryInterface $colors){
        $this ->products= $products;
        $this ->colors = $colors;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $products = Image::getProductImage();
        // dd($products);
        $products_new= Product::where('product_status','=',0)->with('product_detail')->limit(4)->get();
        // dd($products_new);
        $products_coming = Product::where('product_status','=',2)->with('product_detail')->limit(4)->get();
        return view('customer.index',compact('products_new','products_coming'));
    }
    public function typeOne($type_id){
        $products = Product::where('type_id',$type_id)
        ->paginate(8);
          return view('customer.product_category', compact('products'));
    }
    public function productStatus($status) {
        $products = Product::where('product_status',$status)
        ->paginate(8);
          return view('customer.product_category', compact('products'));
        //   return view('customer.product_category');
    }
    public function fillter(Request $request){
        $price = $request->input('price');
        $brandId = $request->input('brand');
        $typeId = $request->input('type');

        $price = $price !== null ? $price:0;
        // dd($price);
            $products = Product::join('product_details', 'products.id', '=', 'product_details.product_id')
            ->where('product_details.price', '>=',$price)
            ->when($brandId, function ($query) use ($brandId) {
                return $query->where('products.brand_id', $brandId);
            })
            ->when($typeId, function ($query) use ($typeId) {
                return $query->where('products.type_id', $typeId);
            })
            ->with('product_detail')
            ->distinct()
            ->paginate(8);
            // ->get();
       
    return view('customer.product_category', compact('products'));
    }
    public function bestSeller(){
         $bestSellingProducts = Product::select('products.product_id', 'products.product_name', DB::raw('SUM(invoice_details.quantity) as total_sold'))
            ->join('product_details', 'products.product_id', '=', 'product_details.product_id')
            ->join('invoice_details', 'product_details.product_id', '=', 'invoice_details.product_id')
            ->groupBy('products.product_id', 'products.product_name')
            ->orderByDesc('total_sold')
            ->limit(10) // Chọn số lượng sản phẩm bán chạy (ở đây là 10) bạn muốn hiển thị
            ->get();

    }
    public function cart() {
        return view('customer.cart');
    }

    public function searchProduct(Request $request){
        $search = $request->search;
        // dd($search);
        $products =  Product::where('product_name', 'like', '%' . $search . '%')->with('product_detail')->paginate(8);
        return view('customer.result',compact('products'));
    }

     // prouduct-list show
     public function getList(){
        $products = Product::with('product_detail')->paginate(8);
        return view('customer.product_category',compact('products'));
    }


    // detail product 
    public function detail(string $id){
        // dd('aloalo');
        $product = $this->products->find($id);
        $image = $product->images;
        
        return view('customer.product_detail', compact('product','image'));
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
    public function getSizeData($id,$color){
        // $color = $request->color;
        $size = Product_detail::getSizeSlect($id,$color);
        $data = [
            'size' => $size,
        ];
        // dd($data);
        return $data;
        
    }
    // get detail id put to cart
    
    
    public function getDetailId($id,$color,$size){
        $detailId = Product_detail::getDetailId($id,$color,$size);
        $data = [
            'detailId' => $detailId,
        ];
        return $data;
    }


    // show detail product
    public function show(string $id)
    {
        //
        $product = $this->products->find($id);
        $brand = $product->brand_id;
        $product_same = Product::where('brand_id', $brand)
        ->with('product_detail')->limit(4)->get();
        // dd($product_same);
        $image = $product->images;
        $product_detail = Product_detail::getPrdDetail($id);
        // $price = Product_detail::where('product_id',$id)->orderBy('price','asc');
        // dd($price);
        $colors = Product_detail::getColor($id);
        $sizes = Product_detail::getSize($id);
        // dd($sizes);
        return view('customer.product_detail', compact('product','image','product_detail','colors','sizes','product_same'));
    }


    // function add to cart
    public function addToCart($id,Request $request){
        $product = Product::findOrFail($id);
        // $color = $request->color;
        // $size = $request -> size;
        $detail_id = $request -> detail_id;
        $request->validate([
            'color' => 'required',
            'size' => 'required',
        ], [
            'color.required' => 'màu sắc không được để trống.',
            'size.required' => 'size không được để trống.',
        ]);
        // dd($detail_id);
        // $quantity = $request -> quantity;
        
        $detail = Product_detail::getProductAddToCart($detail_id);
        // dd($detail);
        foreach($detail as $item){
            $price = $item->price;
            $color = $item->color_name;
            $size = $item->size_name;
        }
        // dd($price,$color,$size);
        $cart = session()->get('cart',[]);
        // $request->session()->flush();
        if(isset($cart[$detail_id])){
            $cart[$detail_id]['quantity']++;
        }
        else{
            $cart[$detail_id] = [
                "product_name" => $product->product_name,
                "thumbnail" => $product->thumbnail,
                "price" => $price,
                "color" => $color,
                "size"  => $size,
                "quantity" => 1
            ];
           
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Thêm sản phẩm vào giỏ hàng thành công');
    }

    public function updateCart(Request $request){
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart successfully updated!');
        }
    }
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('noti');
        }
    }

    // view check out
    public function checkout(){
        
        // dd($user,$ward,$district,$findCity);
        if(Auth::guard('user')->check()==true){
            $city = City::all();
            $user= Auth::guard('user')->user();
            $code=$user->ward_code;
            $ward_value = Ward::where('code',$code)->first();
            $district_value = $ward_value->district;
            $findCity = $district_value->city;
            return view('customer.checkout',compact('city','user','district_value','ward_value','findCity'));
        }   
       else{
        return view('customer.login');
       }
    }
    public function getUserRegister(){
        $city = City::all();
        // dd($city);
        return view('customer.register',compact('city'));
    }
    public function userRegister(Request $request){
        // dd($request->ward);
        $data = [
            'first_name' => $request->customer_firstname,
            'last_name' => $request->customer_lastname,
            'phone_number' => $request->customer_phone,
            'user_address' => $request->address,
            'ward_code' => $request->ward,
        ];
        // dd($data);
        $existingUser = User::where('email', $request->customer_email)->first();
    
        if ($existingUser) {
            // Email đã tồn tại, hiển thị thông báo lỗi và không tạo tài khoản mới
            return redirect()->back()->with('noti','Email đã tồn tại');
        }
    
        // Email chưa tồn tại, tạo tài khoản mới
        $data['email'] = $request->customer_email;
        $data['password'] = Hash::make($request->customer_pass2);
    
        User::create($data);
    
        return view('customer.login')->with('noti','Đăng kí thành công');
    }
    public function getUserLogin(){
        return view('customer.login');
    }
    public function userLogin(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Email không được để trống.',
            'password.required' => 'Mật khẩu không được để trống.',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
   
        if (Auth::guard('user')->attempt($credentials)) {
            $request->session()->regenerate();
            return Redirect::route('customer.index');
        }
        else{
            return back()->with('fail', 'Email hoặc mật khẩu không đúng');
        }
    }
    public function userLogout(){
        Auth::guard('user')->logout();
        return Redirect::route('customer.index');
    }
  
    public function getInfor($id){
        $user = Auth::guard('user')->user();
        return view('customer.info',compact( 'user'));
    }
    public function updateInfor($id,Request $request){
        $email = $request->email;
        User::where('id',$id)->update([
            'email'=>$email
        ]);
        return redirect()->back()->with('successT','cập nhật thành công');
    }
    // lay data dia chi
    public function getInforAddress($id){
        $user = Auth::guard('user')->user();
        $city=City::all();
        return view('customer.address',compact('city','user'));
    }
    public function updateAddress($id, Request $request){
        $ward=$request->ward;
        $address = $request->address;
        // dd($ward,$address);
        User::where('id',$id)->update([
            'user_address'=>$address,
            'ward_code'=>$ward
        ]);
        return redirect()->back()->with('successT','cập nhật thành công');
    }
    public function getDistrict(Request $request,$city){
        $city = $request->city;
        $district = District::getDistrictByCity($city);
        $data =[
            'district' =>$district
        ];
        return $data;
    }
    public function getWard(Request $request,$district){
        $district = $request->district;
        $ward = Ward::getWardByDistrict($district);
        $data =[
            'ward' => $ward
        ];
        return $data;
    }
   


    // thanh toan
    public function payment(Request $request){
            $data=$request->all();
            $user_name = $request->receiver_name;
            $user_phone = $request->receiver_phone;
            // $city = $request->city;
            // $district = $request->district;
            $code = $request->ward;
            $ward = Ward::where(['code' => $code])->first();
            $district = $ward->district;
            $city = $district->city;
            $nameWard = $ward->name;
            $nameDistrict = $district->name;
            $nameCity= $city->name;
            $user_address = $request->receiver_address;
            $total = $request->total;
            $date = Carbon::now()->format('Y-m-d');
            $user_id = $request->user_id;
            // dd($user_id);
            // dd($data, $nameWard,$nameDistrict,$nameCity);
            $new_invoice = Invoice::create([
                'total_amount'=>$total,
                'invoice_status'=>1,
                'date_created'=>$date,
                'user_id'=>$user_id,
                'receiver_name'=>$user_name,
                'receiver_phone'=>$user_phone,
                'receiver_address' => "{$user_address}, {$nameDistrict}, {$nameCity}"
            ]);
            // dd($new_invoice);
            foreach(session('cart') as $id=>$detail){
                Invoice_detail::create([
                    'quantity'=>$detail['quantity'],
                    'invoice_id'=>$new_invoice->id,
                    'product_detail_id'=>$id
                ]);
               $pr= Product_detail::find($id);
            //    dd($pr->product_quantity);
                $new_quantity = $pr->product_quantity - $detail['quantity'];
                // dd($new_quantity);
                Product_detail::where('id',$id)->update([
                    'product_quantity'=>$new_quantity,
                ]);
            }
        // session()->flash('success','dat hang thanh cong');
        Session::forget('cart');
        return Redirect::route('customer.index')->with('success', 'Đặt hàng thành công');
    }
   

     // lic su don hang
     public function history($id){
        $user = Auth::guard('user')->user();
        $invoice = Invoice::where('user_id', $id)->get();
        // dd($invoice);
        return view('customer.history',compact('invoice','user'));
    }
    public function historyDetail($id){
        $invoice_detail = Invoice_detail::getHistory($id);
        $date = Carbon::now()->format('Y-m-d');
        return view('customer.history_detail', compact('invoice_detail','date'));
    }
    public function cancelInvoice($id){
        Invoice::where('id',$id)->update([
            'invoice_status'=>0
        ]);
        return redirect()->back();
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
