<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- bootstrap.min css -->
    <link rel="stylesheet" href="{{ asset('frontoffice/plugins/bootstrap/css/bootstrap.min.css') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/icon.png') }}" type="image/png">

    <style>
        .navbar{
            padding: 1rem 1.5rem;
        }
        .navbar-brand{
            display: flex;
            align-items: center;
        }
        .bg-green{
            background-color: #024102;
        }
        .text-brand{
            color: white;
            font-weight: 700;
            padding-left: 1rem;
        }
        .text-brand span{
            color: rgb(255, 199, 39);
        }
        .text-title{
            text-align: center;
            padding-top: 1.5rem;
            font-weight: 700;
        }
        .content{
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        .content .row{
            width: 50%;
        }
    </style>
</head>
<body>
    <!-- As a heading -->
    <nav class="navbar navbar-light bg-green">
        <a class="navbar-brand" href="#">
            <img src="{{ url('/images/logo-alirsyad.png' )}}" width="100" height="60" class="d-inline-block align-top" alt="">
            <p class="text-brand">Al-Irsyad <span>EDU.</span></p>
        </a>
    </nav>
    <div class="container">
        <h4 class="text-title mb-4">Privacy & Policy</h4>
        <div class="content">
            <div class="row">
                <div class="col-2">
                    <img src="{{ url('/images/icons/camera.png' )}}" alt="">
                </div>
                <div class="col-10">
                    <h6>Camera</h6>
                    <ul>
                        <li>Take pictures and videos</li>
                    </ul>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-2">
                    <img src="{{ url('/images/icons/location.png' )}}" alt="">
                </div>
                <div class="col-10">
                    <h6>Location</h6>
                    <ul>
                        <li>Access precise location (GPS and Network-based)</li>
                        <li>Access approximate location (Network-based)</li>
                    </ul>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-2">
                    <img src="{{ url('/images/icons/storage.png' )}}" alt="">
                </div>
                <div class="col-10">
                    <h6>Storage</h6>
                    <ul>
                        <li>Read content of your SD Card</li>
                        <li>Modify or Delete SD Card Content</li>
                    </ul>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-2">
                    <img src="{{ url('/images/icons/other.png' )}}" alt="">
                </div>
                <div class="col-10">
                    <h6>Others</h6>
                    <ul>
                        <li>Advertising ID Permission</li>
                        <li>Have full network access</li>
                        <li>View network connection</li>
                        <li>Prevent phone from sleeping</li>
                        <li>Play install API reference</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap 4.3.1 -->
    <script src="{{ asset('frontoffice/plugins/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('frontoffice/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>