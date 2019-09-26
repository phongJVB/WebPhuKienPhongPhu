	@extends('master')
	@section('content')	
	<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Đăng kí</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb">
					<a href="index.html">Home</a> / <span>Đăng kí</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	
	<div class="container">
		<div id="content">
             @if(count($errors)>0)
                 <div class="alert alert-danger"> 
                     @foreach( $errors->all() as $err )
                         {{ $err }}<br>
                     @endforeach
                 </div>    
             @endif

             @if(session('notification'))
                 <div class="alert alert-success"> 
                     {{ session('notification') }}
                 </div>
            @endif		
			<form action="{{ Route('home.register') }}" method="post" class="beta-form-checkout">
				@csrf
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						<h4>Đăng kí</h4>
						<div class="space20">&nbsp;</div>
						<div class="form-block">
							<label for="email">Email address <span style="color:red">(*)</span></label>
							<input type="email" id="email" name="txtEmail" required>
						</div>
						<div class="form-block">
							<label for="your_last_name">Fullname <span style="color:red">(*)</span></label>
							<input type="text" id="your_last_name" name="txtFullName" required>
						</div>
						<div class="form-block">
							<label for="adress">Address</label>
							<input type="text" id="adress" name="txtAddress" placeholder="Street Address">
						</div>
						<div class="form-block">
							<label for="phone">Phone</label>
							<input type="text" id="phone" name="txtPhone">
						</div>
						<div class="form-block">
							<label for="phone">Password <span style="color:red">(*)</span></label>
							<input type="text" id="password" name="txtPassword" required>
						</div>
						<div class="form-block">
							<label for="phone">Re password <span style="color:red">(*)</span></label>
							<input type="text" id="re_password" name="txtRePassword" required>
						</div>
						<div class="form-block">
							    <label>Gender</label>
                                <label>
                                    <input name="rdoGender" value="1" checked="" type="radio">Nam
                                </label>
                                <label>
                                    <input name="rdoGender" value="0" type="radio">Nữ
                                </label>
						</div>
						<div class="form-block">
							<button type="submit" class="btn btn-primary">Register</button>
						</div>
					</div>
					<div class="col-sm-3"></div>
				</div>
			</form>
		</div> <!-- #content -->
	</div> <!-- .container -->
	@endsection