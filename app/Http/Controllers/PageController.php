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
use Cart;


class PageController extends Controller
{
    function getHome(){
        $products = Product::all();
        $slides = Slide::all();
        $productsPaginate= Product::paginate(8);
    	return view('pages.home',compact('products','slides','productsPaginate'));
    }

    function getProductType($id){
        //Lấy sản phẩm theo thể loại cần tìm
        $productType = Product::Where('categories_id',$id)->get();
        $categories = Category::all();
        // Lấy tên thể loại
        $category = Category::Where('id',$id)->first();
        // Tìm sản phẩm khách với thể loại cần tìm
        $products = Product::Where('categories_id','<>',$id)->paginate(3);
    	return view('pages.productType', compact('productType','categories','category','products'));
    }

    function getProduct($id){
        $stock = Stock::Where('products_id',$id)->first();
        $product = Product::find($id);
    	return view('pages.product',compact('product','stock'));
    }

    function getSearch(Request $request){
        $keySearch = $request->key;
        $products = Product::where('name','like','%'.$request->key.'%')
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
        $user = Auth::user();
        if($user){
            return view('pages.checkout',compact('user'));
        }
        else{
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
                     ->join('products', 'products.id', '=', 'order_products.products_id')
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
            if(Auth::user()->role == 0){
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
