        @extends('admin.layouts.index')
        @section('content')
 <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Product
                            <small>Edit</small>
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
                        <form action="{{ Route('product.update',$products->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="txtName" placeholder="Please Enter Product Name"value="{{ $products->name }}" />
                            </div> 

                            <div class="form-group">
                                <label>Product Type</label>
                                <select class="form-control" name="optCategory">
                                    @foreach($categories as $item)
                                        @if(  $products->id_cate == $item->id )
                                            <option value="{{ $item->id }}" selected='selected'> {{ $item->name }}</option>
                                        @else
                                            <option value="{{ $item->id }}"> {{ $item->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" min="0" max="100000000"   class="form-control" name="noPrice" placeholder="Please Enter Price" value="{{ $products->unit_price }}"/>
                            </div>

                            <div class="form-group">
                                <label>Promotion Price</label>
                                <input type="number" min="0" max="100000000"   class="form-control" name="noPromotionPrice" placeholder="Please Enter Promotion Price" value="{{ $products->promotion_price }}"/>
                            </div>

                            <div class="form-group">
                                <label>Old Images</label>
                                <div class="img-edit"><img src="upload/products/{{ $products->image }}" alt=""></div>
                            </div>

                            <div class="form-group">
                                <label>New Images</label>
                                <input type="file" name="iputImage" >
                            </div>
                            

                            <div class="form-group">
                                <label>Product Unit</label>
                                <input class="form-control" name="txtUnit" placeholder="Please Enter Unit" value="{{ $products->unit }}" />
                            </div>

                            <div class="form-group">
                                <label>Product Description</label>
                                <textarea id="demo" name="txtDescription" class="ckeditor form-control" rows="3">{{ $products->description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Product Status</label>
                                <label class="radio-inline">
                                    <input name="rdoStatus" value="1"
                                     @if( $products->status == 1 )
                                        {{"checked"}}
                                     @endif
                                     type="radio">New
                                </label>
                                <label class="radio-inline">
                                    <input name="rdoStatus" value="0" 
                                    @if( $products->status == 0 )
                                        {{"checked"}}
                                     @endif  
                                    type="radio">Old
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