        @extends('admin.layouts.index')
        @section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Orders
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
                                <th>Order Name</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Total</th>
                                <th>Payment</th>
                                <th>Note</th>
                                <th>Order Date</th>
                                <th>Status</th>
                                <th>Delete</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $item)
                                <tr class="odd gradeX" align="center">
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->customers_name }}</td>
                                    <td>{{ $item->customers_address }}</td>
                                    <td>{{ $item->customers_email }}</td>
                                    <td>{{ $item->amount }}</td>
                                    <td>{{ $item->payment }}</td>
                                    <td>{!! $item->note !!}</td>
                                    <td>{{ $item->date_order }}</td>

                                    <td>{{ ($item['status']==0)? 'Chưa xử lý':( ($item['status']==1 )? 'Đang vận chuyển':( ($item['status']==2 )? 'Giao thành công':'Hoàn lại' )) }}</td>

                                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="{{ Route('admin.order.destroy', $item->id) }}"> Delete</a></td>
                                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{ Route('admin.order.edit',$item->id) }}">Detail</a></td>
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

