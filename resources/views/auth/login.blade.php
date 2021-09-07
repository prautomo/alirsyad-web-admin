@extends('layouts.frontoffice')

@section('content')
<div class="spacer" style="margin-top: 50px;"></div>
<div class="container" style="min-height: 55vh">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center mb-4">Masuk</h3>
                    <form method="POST" class="justify-content-center d-flex" action="{{ route('login') }}">
                        @csrf
                        <div style="width:300px; margin-bottom:50px">

                            @if (\Session::has('error'))
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Gagal!</strong> {!! \Session::get('error') !!}
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

                            <div class="form-group mb-0">
                                <a href="/register" type="submit" class="btn btn-primary w-100">
                                    <i class="fa fa-user" aria-hidden="true"></i> {{ __('Register') }}
                                </a>

                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="spacer"></div>
@endsection