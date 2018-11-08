<!DOCTYPE html>
<html>

<head>
    @include('includes.head')
    @yield('css')
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        @include('includes.header')

        @include('includes.left-sidebar')

        <div class="content-wrapper">
            @yield('content')
        </div>
        @include('includes.modal')
        @include('includes.footer')

    </div>

    @include('includes.js_lib')
    @yield('js')
</body>
</html>
