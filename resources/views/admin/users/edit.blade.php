@extends('admin.layouts.index')
@section('content')

   <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>Edit</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                    	 @if(count($errors)>0)
                            <div class="alert alert-danger"> 
                                @foreach($errors->all() as $err)
                                    {{ $err }}<br>
                                @endforeach
                            </div>    
                        @endif

                        @if(session('notification'))
                            <div class="alert alert-success"> 
                                {{ session('notification') }}
                            </div>
                        @endif
                        <form action="{{ Route('admin.user.update',$user->id) }}" method="POST">
                        	@csrf
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="txtName" placeholder="Please Enter Username" value="{{ $user->name }}" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="txtEmail" placeholder="Please Enter Email" value="{{ $user->email }}"/>
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="txtPhone" placeholder="Please Enter Phone" value="{{ $user->phone }}"/>
                            </div> 
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" name="txtAddress" placeholder="Please Enter Address" value="{{ $user->address }}"/>
                            </div>                           
                            <div class="form-group">
                                <input type="checkbox" id="changeCheckbox" name="changePassword">
                                <label>Đổi mật khẩu</label>
                                <input type="password" class="form-control removeDisabled"  name="txtPassword" placeholder="Nhập mật khẩu" disabled="" />
                            </div>
                            <div class="form-group">
                                <label>Nhập lại mật khẩu</label>
                                <input type="password" class="form-control removeDisabled" name="txtRePassword" placeholder="Nhập lại mật khẩu" disabled=""/>
                            </div>
							<div class="form-group">
                                <label>User Gender</label>
                                <div class="radioChecked" >
	                                <label class="radio-inline">
	                                    <input name="rdoGender" value="1" 
                                        {{ ($user->gender == 1)?'checked':'' }} type="radio">Nam
	                                </label>
	                                <label class="radio-inline">
	                                    <input name="rdoGender" value="0"
                                        {{ ($user->gender == 0)?'checked':'' }}  type="radio">Nữ
	                                </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>User Level</label>
                             	<div class="radioChecked">
	                                <label class="radio-inline">
	                                    <input name="rdoLevel" value="0" 
                                        {{ ($user->level == 0)?'checked':'' }} type="radio">Customer
	                                </label>
	                                <label class="radio-inline">
	                                    <input name="rdoLevel" value="1"
                                        {{ ($user->level == 1)?'checked':'' }}  type="radio">Employee
	                                </label>
	                                <label class="radio-inline">
	                                    <input name="rdoLevel" value="2"
                                        {{ ($user->level == 2)?'checked':'' }} type="radio">Admin
	                                </label>
                            	</div>
                            </div>
                            <button type="submit" class="btn btn-default">User Add</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>

@endsection

@section('script')
        <script>
            $(document).ready(function(){
                $('#changeCheckbox').change(function(){
                    if($(this).is(':checked')){
                        $('.removeDisabled').removeAttr('disabled');
                    }else{
                        $('.removeDisabled').attr('disabled','');
                    }
                });
            })
        </script> 
@endsection