<!DOCTYPE html>
<html>
<head>
    <title>ItsolutionStuff.com</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body{
            font-family: 'Poppins', sans-serif;
            color: black;
        }

        p{
            font-size: 1rem;
        }

        .center {
            text-align: center;
        }

        .button {
            display: inline-block;
            font-weight: 400;
            color: #fff !important;
            text-align: center;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-color: #024102;
            border: 1px solid #024102;
            padding: 1rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="center">
        <img src="{{ $message->embed(public_path().'/images/banner-email-verification.png') }}" alt="">
    </div>
    <h1>{{ $details['title'] }}</h1>
    <p>Silahkan reset passwod Anda dengan klik tautan dibawah ini :</p>
    
    <div class="center">
        @if($details['source_api_call'] =='ios')         
            <a href="{{ $details['url_link'] . '/reset-password?token=' . $details['token'] . '&email=' . urlencode($details['email']) . '&source=ios'}}" class="button">Reset Password</a>     
        @else
            <a href="{{ $details['url_link'] . '/password/reset/' . $details['token'] . '?email=' . urlencode($details['email']) }}" class="button">Reset Password</a>     
        @endif
    </div>

    <p>Salam</p>
    <p style="font-size: 12pt; font-weight: 700">SD IT Al-Irsyad Al-Islamiyyah</p>
</body>
</html>