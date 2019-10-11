<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Model\User;

class LoginController extends Controller
{
    public function index(){
    	return view('admin.layouts.login');
    }
    public function postLogin(Request $request){
    	$this->validate($request,
            [
                'username'=>'required',
                'password'=>'required|min:6|max:32',
            ],
            [
                'username.required'=>'Bạn chưa nhập tên người dùng',
                'password.required'=>'Bạn chưa nhập Password',
                'password.min'=>'Password không được nhỏ hơn 6',
                'password.max'=>'Password không được lớn hơn 32',

            ]);

        $arr =[
            'name'  => $request->username, 
            'password' => $request->password,
        ];
        if(Auth::attempt($arr)){
            if(Auth::user()->role != 0){
                return redirect()->route('admin.product.index');
            }
        }else{
            return redirect()->back()->with('notification','Tài khoản không tồn tại');
        }
    }
}
