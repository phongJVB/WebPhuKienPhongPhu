<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Category;
use App\Model\Stock;
use Cart;
use Session;

class CartController extends Controller
{
    public function addToCart(Request $request){
    	$productId = $request->productId;
    	$productById = Product::where('id',$productId)->first();
        $stock = Stock::Where('products_id',$productId)->first();
    	Cart::add([
    		'id'=>$productId,
    		'name'=>$productById->name,
    		'price'=>$productById->unit_price,
    		'weight'=>0,
    		'qty'=>$request->qty,
            'options'=>[
                'cateId' => $productById->categories_id,
                'unit' =>  $productById->unit,
                'image'=> $productById->image,
                'stockQty'=> $stock->stock_quantity,
            ]
    	]);
        if($request->modeAddCart==1){
    	   return redirect()->route('home.showShoppingCart');
        }else{
            return redirect()->back();
        }
    }

    public function showCart(){
    	$cartProducts = Cart::Content();
        $categories = Category::all();
    	return view('pages.shopping_cart',compact('cartProducts','categories'));
    }

    public function updateCart(Request $request){
    	Cart::update( $request->rowId, $request->qty);
    	return redirect()->route('home.showShoppingCart');
        // $cartProducts = Cart::get($request->rowId);
        // return response()->json( $cartProducts);

    }

    public function removeCart($rowId){
    	Cart::remove($rowId);
    	return redirect()->route('home.showShoppingCart');
    }
}
