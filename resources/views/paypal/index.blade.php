@extends('layouts.app')

@section('content')
    <legend>Thanh toán qua cổng PayPal</legend>
    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

        <!-- Nhập địa chỉ email người nhận tiền (người bán) -->
        <input type="hidden" name="business" value="nguoiban@hocitonline.com">

        <!-- tham số cmd có giá trị _xclick chỉ rõ cho paypal biết là người dùng nhất nút thanh toán -->
        <input type="hidden" name="cmd" value="_xclick">

        <!-- Thông tin mua hàng. -->
        <input type="hidden" name="item_name" value="HoaDonMuaHang">
        <!--Trị giá của giỏ hàng, vì paypal không hỗ trợ tiền việt nên phải đổi ra tiền $-->
        Nhập số tiền hóa đơn : <input type="number" name="amount" placeholder="Nhập số tiền vào" value="">
        <!--Loại tiền-->
        <input type="hidden" name="currency_code" value="USD">
        <!--Đường link mình cung cấp cho Paypal biết để sau khi xử lí thành công nó sẽ chuyển về theo đường link này-->
        <input type="hidden" name="return" value="http://laravel-blog.test/paypal/success">
        <!--Đường link mình cung cấp cho Paypal biết để nếu  xử lí KHÔNG thành công nó sẽ chuyển về theo đường link này-->
        <input type="hidden" name="cancel_return" value="http://laravel-blog.test/paypal/error">
        <!-- Nút bấm. -->
        <input type="submit" name="submit" value="Thanh toán quay Paypal">
    </form>
@endsection
