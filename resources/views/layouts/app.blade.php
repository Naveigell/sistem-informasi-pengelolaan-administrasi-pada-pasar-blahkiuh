<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @include('layouts.style')
</head>
<body>
    <div id="main-wrapper" class="mini-sidebar" data-sidebartype="full" data-theme="light" data-layout="vertical" data-navbarbg="skin1" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        @include('layouts.header')

        @include('layouts.sidebar')

        <div class="page-wrapper">

            <div class="page-content container-fluid">
                @yield('content')
            </div>

            @include('layouts.footer')
        </div>
    </div>
    @include('layouts.script')
    @stack('scripts')
</body>
</html>
