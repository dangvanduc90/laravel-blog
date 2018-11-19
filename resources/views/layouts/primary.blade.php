<html>
    <head>
        <title>App Name - @yield('title')</title>
        @stack('scripts')
</head>
<body>
@section('sidebar')
    This is the master sidebar.
@show

<div class="container">
    @yield('content')
</div>
</body>
    @yield('script')
</html>