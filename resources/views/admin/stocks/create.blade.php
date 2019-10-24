      
        @extends('admin.layouts.index')
        @section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Stock
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
                        <form action="{{ Route('admin.stock.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Product</label>
                                <input type="hidden" name="stockId" value="{{ $stock->id }}">
                                <input type="text" class="form-control" name="txtNameProduct"  value="{{ $products->name }}" disabled=""/>
                            </div>                      

                            <div class="form-group">
                                <label>Product Quantity</label>
                                <input type="number" min="1"  class="form-control" name="productQuantity" placeholder="Please Enter Product Quantity" value="1" />
                            </div>

                            <div class="form-group">
                                <label>Note</label>
                                <textarea id="demo" name="txtNote" class="ckeditor form-control" rows="3"> </textarea>
                            </div>

                            <button type="submit" class="btn btn-success">Quantity Product Add</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
        @endsection