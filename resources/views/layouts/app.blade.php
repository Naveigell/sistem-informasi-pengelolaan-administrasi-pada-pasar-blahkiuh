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
            <div class="page-breadcrumb border-bottom">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-xs-12 justify-content-start d-flex align-items-center">
                        <h5 class="font-medium text-uppercase mb-0">Dashboard</h5>
                    </div>
                    <div class="col-lg-9 col-md-8 col-xs-12 d-flex justify-content-start justify-content-md-end align-self-center">
                        <nav aria-label="breadcrumb" class="mt-2">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href>Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                        <button class="btn btn-danger text-white ml-3 d-none d-md-block">Buy Ample Admin</button>
                    </div>
                </div>
            </div>

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
