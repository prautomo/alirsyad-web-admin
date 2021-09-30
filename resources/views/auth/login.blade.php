@extends('layouts.frontoffice')

@section('content')
<div class="spacer" style="margin-top: 50px;"></div>
<div class="container" style="min-height: 55vh">
    <div class="row justify-content-center">
        <div class="col-md-5 mb-5">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://via.placeholder.com/800x720?text=Slide+1+800x720" class="d-block w-100" alt="Slide">
                </div>
                <div class="carousel-item">
                    <img src="https://via.placeholder.com/800x720?text=Slide+2+800x720" class="d-block w-100" alt="Slide">
                </div>
                <div class="carousel-item">
                    <img src="https://via.placeholder.com/800x720?text=Slide+3+800x720" class="d-block w-100" alt="Slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            </div>
        </div>
        <div class="col-md-5 mb-5">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center mb-4">Masuk</h3>
                    <form method="POST" class="justify-content-center d-flex" action="{{ route('login') }}">
                        @csrf
                        <div style="width:300px;">

                            @if (\Session::has('error'))
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Gagal!</strong> {!! \Session::get('error') !!}
                                </div>
                            @endif

                            @if (\Session::has('success'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Sukses!</strong> {!! \Session::get('success') !!}
                                </div>
                            @endif

                            
                            <div class="form-group ">
                                <label for="email" class=" col-form-label text-md-right">{{ __('NIS') }}</label>

                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group ">
                                <label for="password" class=" col-form-label text-md-right">{{ __('Password') }}</label>

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <!-- <div class="form-group ">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div> -->

                            <div class="form-group mb-0 text-center">
                                <button type="submit" class="btn btn-main w-100">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="form-group mb-0">
                <a href="/register" type="submit" class="btn btn-primary w-100">
                    <i class="fa fa-user" aria-hidden="true"></i> {{ __('Register') }}
                </a>

            </div>
        </div>
    </div>
</div>
<div class="spacer"></div>
@endsection