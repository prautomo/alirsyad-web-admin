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
    <p>Terima kasih sudah mendaftarkan dirimu di Al Irsyad Edu. Sebentar lagi kamu akan siap memulai pengalaman baru dalam belajar</p>
    <p>Silahkan verifikasi alamat emailmu dengan klik tautan berikut dan memulai login kembali :</p>
   
    <div class="center">
        @if($details['source_api_call'] =='ios')         
            <a href="{{ $details['url_link'] . '/verify-email?email=' . $details['email'] . '&source=ios'}}" class="button">Confirm Email & Login</a>     
        @elseif($details['source_api_call'] =='web')  
            <a href="{{ 'https://user.alirsyadbandung.sch.id/' . 'verify-email/' . $details['email'] }}" class="button">Confirm Email & Login</a>     
        @else
            <a href="{{ $details['url_link'] . '/verify-email?email=' . $details['email'] }}" class="button">Confirm Email & Login</a> 
        @endif
    </div>

    <p>Penting untuk memiliki akun dengan alamat email yang akurat karena semua keterangan investasimu akan dikirim ke sini. Harap abaikan email ini bila kamu tidak pernah mendaftar ke Al Irsyad Edu.</p>

    <p>Salam</p>
    <p style="font-size: 12pt; font-weight: 700">SD IT Al-Irsyad Al-Islamiyyah</p>
</body>
</html>