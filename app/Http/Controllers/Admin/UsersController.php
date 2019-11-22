<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Model\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */     
    public function index()
    {   
        $users = User::all();
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request,
        [   
            'txtName'=>'required',
            'txtEmail'=>'required|email|unique:users,email',
            'txtAddress'=>'required',
            'txtPhone'=>'required',
            'txtPassword'=>'required|min:6|max:32',
            'txtRePassword'=>'required|same:txtPassword'
        ],
        [   'txtName.required'=>'Vui lòng nhập tên đăng nhập',
            'txtEmail.required'=>'Vui lòng nhập Email',
            'txtEmail.email'=>'Không đúng định dạng email',
            'txtEmail.unique'=>'Email đã tồn tại',
            'txtAddress.required'=>'Vui lòng nhập địa chỉ',
            'txtPhone.required'=>'Vui lòng nhập số điện thoại',
            'txtPassword.required'=>'Vui lòng nhập Password',
            'txtPassword.min'=>'Password không được nhỏ hơn 6',
            'txtPassword.max'=>'Password không được lớn hơn 32',
            'txtRePassword.required'=>'Vui lòng nhập RePassword',
            'txtRePassword.same'=>'Mật khẩu không giống',
        ]);
        $user = new User();
        $user-> email = $request->txtEmail;
        $user-> name = $request->txtName;
        $user-> phone = $request->txtPhone;
        $user-> address = $request->txtAddress;
        $user-> gender = $request->rdoGender;
        $user-> role = $request->rdoLevel;
        $user-> password = bcrypt($request->txtPassword);
        $user->save();

        return redirect()->back()->with('notification','Thêm thành công người dùng');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $user = User::find($id);
        return view('admin.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $user = User::find($id);
      $this->validate($request,
        [   
            'txtName'=>'required',
            'txtEmail'=>'required|email|unique:users,email',
            'txtAddress'=>'required',
            'txtPhone'=>'required',
        ],
        [   'txtName.required'=>'Vui lòng nhập tên đăng nhập',
            'txtEmail.required'=>'Vui lòng nhập Email',
            'txtEmail.email'=>'Không đúng định dạng email',
            'txtEmail.unique'=>'Email đã tồn tại',
            'txtAddress.required'=>'Vui lòng nhập địa chỉ',
            'txtPhone.required'=>'Vui lòng nhập số điện thoại',
        ]);
        $user-> email = $request->txtEmail;
        $user-> name = $request->txtName;
        $user-> phone = $request->txtPhone;
        $user-> address = $request->txtAddress;
        $user-> gender = $request->rdoGender;
        $user-> role = $request->rdoLevel;

        if($request->changePassword =="on"){
            $this->validate($request,
        [   
            'txtPassword'=>'required|min:6|max:32',
            'txtRePassword'=>'required|same:txtPassword'
        ],
        [   
            'txtPassword.required'=>'Vui lòng nhập Password',
            'txtPassword.min'=>'Password không được nhỏ hơn 6',
            'txtPassword.max'=>'Password không được lớn hơn 32',
            'txtRePassword.required'=>'Vui lòng nhập RePassword',
            'txtRePassword.same'=>'Mật khẩu không giống',
        ]);
            $user-> password = bcrypt($request->txtPassword); 
        }

        $user->save();

        return redirect()->back()->with('notification','Sửa thành công người dùng');  
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin.user.index')->with('notification','Bạn đã xóa thành công');
    }
}
