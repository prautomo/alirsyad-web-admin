@extends('layouts.backoffice')

@section('title', __("Profile"))

@section('content')
<div class="container mt-4">
    <div class="d-flex flex-column align-items-start" >
        <div class="mb-4 mt-4 prod-page-header">
            <h3>Profile</h3>
        </div>
        @if(Session::has('success'))
        <div class="alert alert-success w-100">
            {{Session::get('success')}}
        </div>
        @endif
        <div class="row" style="width: 100%;">

            <div class="col-lg-4">
                <div class="card text-center col-lg-12 mb-4">
                    <div class="card-body">
                        <img src="{{$user_data->photo != '' ? $user_data->photo : '/images/placeholder.png'}}" width="200px" height="200px" class="img-fluid rounded-circle" alt="" style="background-color: #eee;height: 200px;">

                        <div class="btn-group mt-4" role="group" aria-label="Edit">
                            <!-- <button type="button" class="btn btn-main btn-small">
                                Edit Profile
                            </button> -->
                            <a href="{{ route('backoffice::akun-saya.password-edit') }}" type="button" class="ml-1 btn btn-primary btn-small">
                                Edit Password
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="row">

                    <div class="card text-left col-lg-12 mb-4">

                        <div class="card-body">

                            <div class="card-title">
                                <h1>Akun Saya</h1>
                                <hr style="margin:0;"/>
                            </div>
                            @if(@\Auth::user()->hasRole('Guru Uploader'))
                            <div class="form-group">
                                <label>NIP</label>
                                <input type="text" disabled value="{{ @$user_data->nis }}" class="form-control" />
                            </div>
                            @endif
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

                            <!-- <div class="form-group">
                                <label>Kelas Aktif</label>
                                <input type="text" disabled 
                                    value="{{ @$user_data->kelas->tingkat->jenjang->name ?? 'undefined' }} - Kelas {{ @$user_data->kelas->tingkat->name ?? 'undefined' }}{{ @$user_data->kelas->name ?? 'undefined' }}" 
                                    class="form-control" 
                                />
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection