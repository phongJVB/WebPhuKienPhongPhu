        @extends('admin.layouts.index')
        @section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Stock
                            <small>List</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                     @if(session('notification'))
                        <div class="alert alert-success" style="position: relative; clear: both; width: 40%;"> 
                            {{ session('notification') }}
                        </div>
                    @endif
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Total Import Quantity</th>
                                <th>Stock Quantity</th>
                                <th>View Detail</th>
                                <th>Add Import Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stocks as $item)
                                <tr class="odd gradeX" align="center">
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->total_quantity }}</td>
                                    <td>{{ $item->stock_quantity }}</td>
                                    <td class="center"><i class="fa fa-eye fa-fw"></i> <a href="{{ Route('admin.stock.show',$item->id) }}">Watch</a></td>
                                     <td class="center"><i class="fa fa-plus fa-fw"></i> <a href="{{ Route('admin.stock.create', $item->id) }}">Add</a></td>
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

