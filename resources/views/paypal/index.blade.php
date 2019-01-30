@extends('layouts.app')

@section('content')
    <legend>Thanh toán qua cổng PayPal</legend>
    <form action="{{ url('/paypal/store') }}" method="post" >
        {{ csrf_field() }}
        <input type="hidden" name="cmd" value="_s-xclick">
        <button>Payment</button>
    </form>
@endsection
