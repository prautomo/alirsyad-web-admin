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
        .button {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 101px;
            font-weight: 600 !important;
            text-decoration: none;
            background-color: #024102;
            color: #fff !important;
            border-radius: 10px;
            color: #333333;
            padding: 20px 20px;
            margin-left: 400px;
            text-align: center;
        }
    </style>
</head>
<body>
    <img src="{{ $message->embed(public_path().'/images/banner-email-verification.png') }}" alt="">
    <h1>{{ $details['title'] }}</h1>
    <p>Silahkan reset passwod Anda dengan klik tautan dibawah ini :</p>
    
    <div style="height: 4rem">
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