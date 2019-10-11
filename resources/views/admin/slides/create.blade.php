      
        @extends('admin.layouts.index')
        @section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Slide
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
                        <form action="{{ Route('admin.slide.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Title</label>
                                <input class="form-control" name="txtTitle" placeholder="Please Enter Title"/>
                            </div>                        

                            <div class="form-group">
                                <label>Images</label>
                                <input type="file" name="inputImage">
                            </div>

                            <button type="submit" class="btn btn-default">Slide Add</button>
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