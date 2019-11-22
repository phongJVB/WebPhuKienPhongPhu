@extends('pages.account')

@section('title')
Lịch sử đơn hàng
@endsection

@section('contentAccount')
<div class="col-sm-9 contentAccount">
	<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                    <h4 class="page-header-account"> Lịch sử đơn hàng </h4>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr align="center">
                                <th>Đơn hàng</th>
                                <th>Tổng tiền</th>
                                <th>Thanh toán</th>
                                <th>Chú thích</th>
                                <th>Ngày đặt</th>
                                <th>Trạng thái</th>
                                <th>Chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order as $key => $item)
                                <tr class="odd gradeX" align="center">
                                    <td class="center">{{ ++$key }}</td>
                                    <td>{{ number_format($item->amount,'0','','.') }}</td>
                                    <td>{{ $item->payment }}</td>
                                    <td>{!! $item->note !!}</td>
                                    <td>{{ $item->date_order }}</td>
                                    <td>{{ ($item['status']==0)? 'Chưa xử lý':( ($item['status']==1 )? 'Đang vận chuyển':( ($item['status']==2 )? 'Giao thành công':'Hoàn lại' )) }}</td>
                                     <td class="center"><a href="{{ Route('home.historyOrderDetail',[ $item->id, $user->id]) }}"><i class="fa fa-eye" style="font-size:20px;color: #FFD200"></i> </a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
</div>
@endsection