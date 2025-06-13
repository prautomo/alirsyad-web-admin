<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Session Expired</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}"> {{-- Optional: Link to your CSS --}}
        <style>
            body {
            font-family: sans-serif;
            background-color: #f8f8f8;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            }
            .container {
            text-align: center;
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            }
            h1 {
            color: #e74c3c;
            margin-bottom: 20px;
            }
            p {
            color: #555;
            font-size: 1.1em;
            margin-bottom: 30px;
            }
            a {
            display: inline-block;
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            }
            a:hover {
            background-color: #2980b9;
            }
        </style>
</head>
<body>
<div class="container">
<h1>Sesi Anda Telah Berakhir</h1>
<p>Maaf, sesi Anda telah berakhir karena tidak ada aktivitas. Silakan masuk kembali untuk melanjutkan.</p>
<a href="{{ route('login') }}">Masuk Kembali</a> {{-- Or your desired login route --}}
</div>
</body>
</html>
