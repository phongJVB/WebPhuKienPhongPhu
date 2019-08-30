<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class PageController extends Controller
{
    function getHome(){
    	return view('pages.home');
    }

    function getProductType(){
    	return view('pages.productType');
    }

    function getProduct(){
    	return view('pages.product');
    }

    function getAbout(){
    	return view('pages.about');
    }

    function getContact(){
    	return view('pages.contact');
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


        if(Auth::attempt([ 'email'  => $request->txtEmail, 'password' => $request->password,'level'=>'1' ]))
        {
            return redirect()->route('home.index');

        }elseif(Auth::attempt([ 'email'  => $request->txtEmail, 'password' => $request->password,'level'=>'2']))
        {
            return redirect()->route('admin');
        }else
        {
            return redirect()->route('home.login')->with('notification','Tài khoản không tồn tại');
        }
    }

    function getRegister(){
        return view('pages.register');
    }


}
