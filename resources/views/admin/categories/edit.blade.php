        @extends('admin.layouts.index')
        @section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Category
                            <small>Edit</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
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
                        <form action="admin/category/update/{{ $category->id }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Category Name</label>
                                <input class="form-control" name="txtCateName" placeholder="Please Enter Category Name" value="{{ $category->name }}" />
                            </div>
                            <div class="form-group">
                                <label>Category Description</label>
                                <textarea class="form-control" rows="3" name="txtDescription">{{ $category->description }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-default">Category Edit</button>
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