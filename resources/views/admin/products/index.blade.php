        @extends('admin.layouts.index')
        @section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header-account">Product
                            <small>List </small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                     @if(session('notification'))
                        <div class="alert alert-success" style="position:relative; clear:both; width:40%;"> 
                            {{ session('notification') }}
                        </div>
                    @endif
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Detail Description</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listProduct as $item)
                                <tr class="odd gradeX" align="center">
                                    <td>{{ $item->id }}</td>
                                    <td class="text-left">{{ $item->name }}</td>
                                    <td class="text-left">{{ $item->description }}</td>
                                    <td class="text-left">{!! $item->detail_description !!}</td>
                                    <td>{{ $item->unit_price }}</td>
                                    <td>{{ ($item['status']==1) ? 'Mới':'Cũ'}}</td>
                                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="{{ Route('admin.product.destroy', $item->id) }}"> Delete</a></td>
                                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{ Route('admin.product.edit', $item->id) }}">Edit</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        @endsection

