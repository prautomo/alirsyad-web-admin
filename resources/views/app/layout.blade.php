<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Ferdhika Yudira">
    <!--Load Stylesheets-->
    <link rel='stylesheet' href="{{ asset('css/bootstrap-grid.css') }}" />
    <link rel='stylesheet' href="{{ asset('css/bootstrap-grid.min.css') }}" />
    <link rel='stylesheet' href="{{ asset('css/bootstrap.css') }}" />
    <link rel='stylesheet' href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel='stylesheet' href="{{ asset('css/bootstrap-reboot.css') }}" />
    <link rel='stylesheet' href="{{ asset('css/bootstrap-reboot.min.css') }}" />
    <link rel='stylesheet' href="{{ asset('css/fly.min.css') }}" />
    <link rel='stylesheet' href="{{ asset('css/app.css') }}" />
    <link rel='stylesheet' href="{{ asset('css/main.css') }}" />
    <!--End Stylesheets-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ asset('images/logo.png') }}" sizes="32x32" type="image/png">
    <title>
        {{ config('app.name', 'Digital Interactive Book') }}
    </title>
</head>

<body>
    @include('app/header')

    @yield('content')

</body>

</html>
<!--Load Javascript-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script> -->
<!-- <script src="{{ asset('js/bootstrap.js') }}"></script> -->
<!-- <script src="{{ asset('js/bootstrap.min.js') }}"></script> -->

<script src="{{ asset('js/fly.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>

<script>
    $(document).ready(function() {
        //Default 
        function normalstate(norm) {
            $(norm).css({
                opacity: "1"
            });
        }
        //rocketPulse Effect Animation 
        $('.btn_rocketPulse').on('click', function() {
            rocketcss(this, '.target', 'rocketPulse');
            $('.target').addClass('targetPulse');
            setTimeout(function() {
                normalstate('.rocket');
                $('.target').removeClass('targetPulse');
            }, 2300);
        });
    });
</script>

@yield("js")