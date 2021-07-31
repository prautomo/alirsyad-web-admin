@extends("app/layout")

@section('content')
<div class="spacer"> </div>
<div class="container " style="margin-top:100px">
    @if(Auth::user() ? Auth::user()->role == "CUSTOMER" : false)
    <div id="jasa-container">
        <h4>Sedang Memuat</h4>
    </div>

    @else

    <h3>Anda Harus Masuk Terlebih Dahulu</h3>
    @endif
</div>
<div class="spacer"> </div>

@endsection