<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('tab-title')
    @include('layouts.link.css')
    @yield('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    @yield('Onbody')
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{asset('/image/123.png')}}" alt="អាជ្ញាធរសវនកម្មជាតិ" height="300"
                width="250"> <br>
            <p style="font-family:'Khmer OS Muol Light'; font-size: 28px; color: blue;">អាជ្ញាធរសវនកម្មជាតិ</p>
        </div>
        <!-- Navbar -->
        @include('layouts.NewLayout.navbar')
        <!-- Sidebar -->
        @include('layouts.sidebar')
        <!-- dynamic content  -->
        @include('layouts.NewLayout.UI.body')
    </div>
    <!-- footer -->
    @include('layouts.NewLayout.UI.footer')

    @include('layouts.link.js')

    @yield('js')
</body>

</html>