@extends('admin.layouts.index')
@section('content')

   <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Slide
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
                        <form action="{{ Route('admin.slide.update',$slide->id) }}" method="POST" enctype="multipart/form-data">
                        	@csrf
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="txtTitle" placeholder="Please Enter Username" value="{{ $slide->title }}" />
                            </div>

                              <div class="form-group">
                                <label>Old Images</label>
                                <div class="img-edit-slide"><img src="upload/slides/{{ $slide->image }}" alt=""></div>
                            </div>

                            <div class="form-group">
                                <label>New Images</label>
                                <input type="file" name="inputImage" >
                            </div>
                            

                            <button type="submit" class="btn btn-default">Slide Update</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>

@endsection