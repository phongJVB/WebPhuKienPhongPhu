<h4>Xác nhận thông tin trước khi vận chuyển hàng</h4>
<p><strong>Name:</strong>{{ $customers_name }}</p></br>
<p><strong>Email:</strong>{{ $customers_email }}</p></br>
<p><strong>Address:</strong>{{ $customers_address }}</p></br>
<p><strong>Phone:</strong>{{ $customers_phone }}</p></br>
<p><strong>Tổng tiền đơn hàng:</strong>{{ $amount }}</p></br>
<p><strong>Xác nhận thông tin chính xác truy cập vào link sau:</strong></br>
{{ Route('home.checkoutActivation',$token) }}</p>
