<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@include('admin.layouts.head')
@include('admin.layouts.header')
@include('admin.layouts.sidebar')

<body class="skin-red hold-transition sidebar-mini">
<div class="wrapper">
    @yield('content')
</div>
</body>
@include('admin.layouts.footer')
@yield('js')
</html>