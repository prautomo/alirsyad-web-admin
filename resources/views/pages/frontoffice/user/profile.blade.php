@extends('layouts.frontoffice')

@section('title', __("Profile"))

@section('content')
<section class="mt-4">
	<div class="container">
        <div class="row mb-2">
            <div class="col-md-12 text-left">
                <h3>Akun Saya</h3>
            </div>
        </div>
        <div class="row">
            @if(Session::has('success'))
            <div class="alert alert-success w-100">
                {{Session::get('success')}}
            </div>
            @endif

            <div class="col-md-4">
                <div class="card text-center col-lg-12 mb-4">
                    <div class="card-body">
                        <img src="{{$user_data->photo != '' ? $user_data->photo : '/images/placeholder.png'}}" width="200px" height="200px" class="img-fluid rounded-circle" alt="" style="background-color: #eee;height: 200px;">
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                    <div class="card text-left mb-4">

                        <div class="card-body">

                            <div class="card-title">
                                <h5>Akun Saya</h5>
                                <hr/>
                            </div>
                            <div class="form-group">
                                <label>NIS</label>
                                <input type="text" disabled value="{{ @$user_data->nis }}" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" disabled value="{{ @$user_data->name }}" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" disabled value="{{ @$user_data->email }}" class="form-control" />
                                <!-- <span style="width:200px" class="badge  badge-{{$user_data->email_verified_at ? 'success' : 'danger'}} text-center">{{$user_data->email_verified_at ? "Email Terverifikasi" :  "Email Belum Terverifikasi"}}</span>

                                @if(!$user_data->email_verified_at )

                                <a href="/app/verification/resend" onclick="event.preventDefault();
                                        document.getElementById('resend-form').submit();">
                                    Kirim Ulang Email
                                </a>

                                <form id="resend-form" action="/app/verification/resend" method="POST" class="d-none">
                                    @csrf
                                </form>
                                @endif -->
                            </div>

                            <div class="form-group">
                                <label>Kelas Aktif</label>
                                <input type="text" disabled 
                                    value="{{ @$user_data->kelas->tingkat->jenjang->name ?? 'undefined' }} - Kelas {{ @$user_data->kelas->tingkat->name ?? 'undefined' }}{{ @$user_data->kelas->name ?? 'undefined' }}" 
                                    class="form-control" 
                                />
                            </div>

                            <div class="form-group mt-2 text-center">
                                <!-- <button type="button" class="btn btn-main btn-small">
                                    Edit Profile
                                </button> -->
                                <a href="{{ route('app.akun-saya.password-edit') }}" type="button" class="ml-1 btn btn-main btn-small">
                                    Edit Password
                                </a>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
</section>
@endsection