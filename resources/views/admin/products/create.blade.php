      
        @extends('admin.layouts.index')
        @section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Product
                            <small>Add</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <!-- Hiển thị thông báo lỗi và thông báo thành công thi thêm sản phẩm -->
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
                        <!-- Hiển thị form thêm sản phẩm-->
                        <form action="{{ Route('product.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="txtName" placeholder="Please Enter Product Name" />
                            </div>                            
                            <div class="form-group">
                                <label>Product Type</label>
                                <select class="form-control" name="optCategory">
                                    @foreach($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" min="0" max="100000000"   class="form-control" name="noPrice" placeholder="Please Enter Price" />
                            </div>
                            <div class="form-group">
                                <label>Promotion Price</label>
                                <input type="number" min="0" max="100000000"   class="form-control" name="noPromotionPrice" placeholder="Please Enter Promotion Price" />
                            </div>
                            <div class="form-group">
                                <label>Images</label>
                                <input type="file" name="iputImage">
                            </div>
                            <div class="form-group">
                                <label>Product Unit</label>
                                <input class="form-control" name="txtUnit" placeholder="Please Enter Unit" />
                            </div>
                            <div class="form-group">
                                <label>Product Description</label>
                                <textarea id="demo" name="txtDescription" class="ckeditor form-control" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Product Status</label>
                                <label class="radio-inline">
                                    <input name="rdoStatus" value="1" checked="" type="radio">New
                                </label>
                                <label class="radio-inline">
                                    <input name="rdoStatus" value="0" type="radio">Old
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Product Add</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
        @endsection