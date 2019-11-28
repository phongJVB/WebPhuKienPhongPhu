<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Validator;
use App\Model\User;
use App\Model\Product;
use App\Model\Category;
use App\Model\Order;
use App\Model\OrderProduct;
use App\Model\Slide;
use App\Model\Stock;
use App\Model\Comment;
use App\Model\ImagesProduct;
use Cart;


class PageController extends Controller
{
    function getHome(){
        $products = Product::Where('status',1)->Where('delete_flag',0)->get();
        //Lấy ra các sản phẩm mới trên thị trường. Kết quả sẽ là 1 object gồm các class product
        $slides = Slide::all();
        $productsPaginate= Product::Where('delete_flag',0)->paginate(8);
    	return view('pages.home',compact('products','slides','productsPaginate'));
    }

    function getProductType($id){
        //Lấy sản phẩm theo thể loại cần tìm
        $productType = Product::Where('categories_id',$id)->Where('delete_flag',0)->get();
        $categories = Category::all();
        // Lấy tên thể loại
        $category = Category::Where('id',$id)->first();
        // Tìm sản phẩm khách với thể loại cần tìm
        $products = Product::Where('categories_id','<>',$id)->Where('delete_flag',0)->paginate(3);
    	return view('pages.productType', compact('productType','categories','category','products'));
    }

    function getProduct($id){
        $stock = Stock::Where('products_id',$id)->first();
        $product = Product::find($id);
        $imagesProduct = ImagesProduct::Where('products_id',$id)->get();
        //Lấy ra sản phẩm tương tự
        $productType = Product::Where('categories_id',$product->categories_id)->paginate(3);
        // Lấy 4 sản phẩm bán chạy
        $productBestSale = DB::table('order_products')
                     ->select('products_id','products.*',DB::raw('SUM(products_quantity) AS total_sale_quantity'))
                     ->join('orders', 'orders.id', '=', 'order_products.orders_id')
                     ->join('products', 'products.id', '=', 'order_products.products_id')
                     ->where('orders.status', '<>', 3)
                     ->groupBy('products_id')
                     ->orderBy('total_sale_quantity','desc')
                     ->limit(4)
                     ->get();
        //Lấy ra sản phẩm mới trên thị trường
        $productNews = DB::table('products')
                    ->select('products.*')
                    ->where('products.status','1')
                    ->limit(4)
                    ->get();

    	return view('pages.product',compact('product','stock','productType','productBestSale','productNews','imagesProduct'));
    }

    function getSearch(Request $request){
        $keySearch = $request->key;
        $products = Product::where('name','like','%'.$request->key.'%')
        					->where('delete_flag',0)
                            ->orWhere('unit_price',$request->key)
                            ->paginate(8);
        return view('pages.search',compact('products','keySearch'));
    }

    function getAbout(){
    	return view('pages.about');
    }

    function getContact(){
    	return view('pages.contact');
    }

    function getCheckout(){
        if(Auth::check()){
            $user = Auth::user();
            if($user->role == 0 && $user->delete_flag == 0){
                return view('pages.checkout',compact('user'));
            }
            else{
               //Nếu phiên trên cùng trình duyệt là Admin thì phải logout 
               Auth::logout();
               return view('pages.checkout'); 
            }  
        }else{
            return view('pages.checkout'); 
        }
           
    }

    // Xử lý lưu thông tin đơn hàng
    function postCheckout(Request $request){
        $order = new Order();
        $cart = Cart::content();
        $total = Cart::subtotal();
        $convertTotal= str_replace(',','', $total);

        if (count($cart) >0) {

            $order->customers_id = $request->customersId;
            $order->customers_name = $request->txtName;
            $order->customers_gender = $request->gender;
            $order->customers_email = $request->txtEmail;
            $order->customers_address = $request->txtAddress;
            $order->customers_phone = $request->txtPhone;
            $order->note = $request->txtNote;
            $order->payment = $request->payment;
            $order->amount = $convertTotal;
            $order->date_order = date('Y-m-d');
            $order->save();

            foreach ($cart as $key => $item) {
                $orderProduct = new OrderProduct();
                $orderProduct->orders_id = $order->id;
                $orderProduct->products_id= $item->id;
                $orderProduct->products_unit_price = $item->price;
                $orderProduct->products_quantity = $item->qty;
                $orderProduct->products_unit = $item->options->unit;
                $orderProduct->save();
            }

            //Tính toán sản phẩm còn lại trong kho lưu vào Stock
            $productSale = DB::table('order_products')
                     ->select('products_id','products.name',DB::raw('SUM(products_quantity) AS total_sale_quantity'))
                     ->join('orders', 'orders.id', '=', 'order_products.orders_id')
                     ->join('products', 'products.id', '=', 'order_products.products_id')
                     ->where('orders.status', '<>', 3)
                     ->groupBy('products_id')
                     ->get();//Lấy ra số lượng đã bán của từng sản phẩm

            $stockList = Stock::all(); //Lấy ra các số lượng nhập vào trong kho

            foreach ($stockList as $key => $item) {
                foreach ($productSale as $itemSale) {
                    if( $item->products_id == $itemSale->products_id ){
                        $stock = Stock::where('products_id',$item->products_id)->first();
                        $stock->stock_quantity = ($item->total_quantity)-($itemSale->total_sale_quantity);
                        $stock->save();
                    }
                }
            }

            Cart::destroy();

            return redirect()->back()->with('notification','Đặt hàng thành công');
            
        } else{

            return redirect()->back()->with('notification','Giỏ hàng trống! Khách hàng vui lòng đặt hàng');

        }

        
    }


    function getLogin(){
        return view('pages.login');
    }

    function postLogin(Request $request){
        $this->validate($request,
            [
                'txtEmail'=>'required',
                'password'=>'required|min:6|max:32',
            ],
            [
                'txtEmail.required'=>'Bạn chưa nhập Email',
                'password.required'=>'Bạn chưa nhập Password',
                'password.min'=>'Password không được nhỏ hơn 6',
                'password.max'=>'Password không được lớn hơn 32',

            ]);

        $arr =[
            'email'  => $request->txtEmail, 
            'password' => $request->password,
        ];

        if(Auth::attempt($arr)){
            if(Auth::user()->role == 0 && Auth::user()->delete_flag == 0 ){
                return redirect()->route('home.index');
            }else{
                return redirect()->back()->with('notification','Tài khoản không tồn tại');
            }
        }else{
            return redirect()->back()->with('notification','Tài khoản không tồn tại');
        }
    }

    function getRegister(){
        return view('pages.register');
    }

    function postRegister(Request $request){
        $this->validate($request,
        [
            'txtEmail'=>'required|email|unique:users,email',
            'txtFullName'=>'required|min:2|max:32',
            'txtAddress'=>'required',
            'txtPhone'=>'required|regex:/^[0-9]{10}$/',
            'txtPassword'=>'required|min:6|max:32',
            'txtRePassword'=>'required|same:txtPassword'
        ],
        [
            'txtEmail.required'=>'Vui lòng nhập Email',
            'txtEmail.email'=>'Không đúng định dạng email',
            'txtEmail.unique'=>'Email đã tồn tại',
            'txtFullName.required'=>'Vui lòng nhập tên đầy đủ',
            'txtFullName.min'=>'Password không được nhỏ hơn 2',
            'txtFullName.max'=>'Password không được lớn hơn 32',
            'txtAddress.required'=>'Vui lòng nhập địa chỉ',
            'txtPhone.required'=>'Vui lòng nhập số điện thoại',
            'txtPhone.regex'=>'Số điện thoại không đúng định dạng',
            'txtPassword.required'=>'Vui lòng nhập Password',
            'txtPassword.min'=>'Password không được nhỏ hơn 6',
            'txtPassword.max'=>'Password không được lớn hơn 32',
            'txtRePassword.same'=>'Mật khẩu không giống',
        ]);
        $user = new User();
        $user-> email = $request->txtEmail;
        $user-> name = $request->txtFullName;
        $user-> phone = $request->txtPhone;
        $user-> address = $request->txtAddress;
        $user-> gender = $request->rdoGender;
        $user-> password = bcrypt($request->txtPassword);
        $user->save();

        return redirect()->back()->with('notification','Thêm thành công người dùng');

    }

    function getLogout(){
        Auth::logout();
        Cart::destroy();
        return redirect()->route('home.index');
    }
    


}
