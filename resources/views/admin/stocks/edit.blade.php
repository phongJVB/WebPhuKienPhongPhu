@extends('admin.layouts.index')
@section('content')

   <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Stock
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
                        <form action="{{ Route('admin.stock.update',$stockDetail->id) }}" method="POST" >
                        	@csrf                    
                            <div class="form-group">
                                <label>Import Quantity</label>
                                <input type="number" min="1"  class="form-control" name="productQuantity" placeholder="Please Enter Import Quantity" value="{{ $stockDetail->import_quantity }}" />
                            </div>

                            <div class="form-group">
                                <label>Note</label>
                                <textarea id="demo" name="txtNote" class="ckeditor form-control" rows="3" disabled >{!! $stockDetail->note !!} </textarea>
                            </div>

                            <button type="submit" class="btn btn-success">Quantity Product Update</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>

@endsection