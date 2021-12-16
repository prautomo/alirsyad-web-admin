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

            @if(@\Auth::user()->hasRole('Guru Uploader'))
            <div class="col-lg-4">
                <div class="card text-center col-lg-12 mb-4">
                    <div class="card-body">
                        <img id="profileImage" src="{{$user_data->photo != '' ? asset($user_data->photo) : '/images/placeholder.png'}}" width="200px" height="200px" class="img-fluid rounded-circle" alt="" style="background-color: #eee;height: 200px;">
                        
                        <form id="change-photo-form" action="{{ route('backoffice::akun-saya.photo') }}" method="POST" enctype="multipart/form-data" class="d-none">
                            @csrf
                            <input type="file" id="img_upload" name="file" accept="image/*" /> 
                        </form>
                        
                        <button class="mt-3 btn btn-small btn-primary" id="selectPhoto">Pilih Foto</button>

                        <button class="mt-3 btn btn-small btn-secondary" 
                            id="savePhoto"
                            onclick="event.preventDefault();
                                        document.getElementById('change-photo-form').submit();"
                        >Simpan</button>
                    </div>
                </div>
            </div>
            @endif

            @if(@\Auth::user()->hasRole('Guru Uploader'))
            <div class="col-lg-8">
            @else
            <div class="col-lg-12">
            @endif
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
                                <!-- <span style="width:200px" class="badge  badge-{{@$user_data->email_verified_at ? 'success' : 'danger'}} text-center">{{@$user_data->email_verified_at ? "Email Terverifikasi" :  "Email Belum Terverifikasi"}}</span>

                                @if(!@$user_data->email_verified_at )

                                <a href="/app/verification/resend" onclick="event.preventDefault();
                                        document.getElementById('resend-form').submit();">
                                    Kirim Ulang Email
                                </a>

                                <form id="resend-form" action="/app/verification/resend" method="POST" class="d-none">
                                    @csrf
                                </form>
                                @endif -->
                            </div>
                            
                            @php
                            $arr = @$user_data->mataPelajarans ?? collect([]);
                            $arr = @$arr->pluck('name') ?? collect([]);
                            $mengajar = implode(", ", $arr->toArray());
                            @endphp

                            @if(@\Auth::user()->hasRole('Guru Uploader'))
                            <div class="form-group">
                                <label>Uploader di Mata Pelajaran</label>
                                <input type="text" disabled 
                                    value="{{ @$mengajar!=='' ? @$mengajar : '-' }}" 
                                    class="form-control" 
                                />
                            </div>
                            @endif

                            <div class="form-group mt-2 text-center">
                                <a href="{{ route('backoffice::akun-saya.profile-edit') }}" type="button" class="btn btn-secondary btn-small">
                                    Ubah Profil
                                </a>
                                <a href="{{ route('backoffice::akun-saya.password-edit') }}" type="button" class="ml-1 btn btn-primary btn-small">
                                    Ubah Password
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@push('script')
<script>

    $(() => {
        $("#savePhoto").hide();
    });

    $('#selectPhoto').click(function(){ $('#img_upload').click(); });


    $("#img_upload").change(function (event) {
        readURL(this);

        $("#savePhoto").show();
        $("#savePhoto").show();
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#profileImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);

            console.log("dika file", input)
        }
    }
</script>
@endpush