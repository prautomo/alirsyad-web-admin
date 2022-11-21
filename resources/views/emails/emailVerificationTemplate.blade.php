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
            width: 150px;
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
    <p>Terima kasih sudah mendaftarkan dirimu di Al Irsyad Edu. Sebentar lagi kamu akan siap memulai pengalaman baru dalam belajar</p>
    <p>Silahkan verifikasi alamat emailmu dengan klik tautan berikut dan memulai login kembali :</p>
   
    <div style="height: 4rem">
        @if($details['source_api_call'] =='ios')         
            <a href="{{ $details['url_link'] . '/verify-email?email=' . $details['email'] . '&source=ios'}}" class="button">Confirm Email & Login</a>     
        @else
            <a href="{{ $details['url_link'] . '/verify-email?email=' . $details['email'] }}" class="button">Confirm Email & Login</a>     
        @endif
    </div>

    <p>Penting untuk memiliki akun dengan alamat email yang akurat karena semua keterangan investasimu akan dikirim ke sini. Harap abaikan email ini bila kamu tidak pernah mendaftar ke Al Irsyad Edu.</p>

    <p>Salam</p>
    <p style="font-size: 12pt; font-weight: 700">SD IT Al-Irsyad Al-Islamiyyah</p>
</body>
</html>