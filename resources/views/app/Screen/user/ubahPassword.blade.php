@extends("app/layout")

@section('content')



<div class="spacer"> </div>
<div class="container">
    <div class="d-flex flex-column align-items-start" style="margin-top: 100px;">
        <div class="mb-4 mt-4 prod-page-header">
            <h3>Profile</h3>
        </div>
        <div class="row" style="width: 100%;">

            @include("app.Screen.customer.sidebar")
            <div class="col-lg-9">
                <div class="row">



                    <div class="card text-left col-lg-12">

                        <div class="card-body pl-1 pr-1">
                            <div class="card border-none  " style="background-color: transparent;">
                                <h3>Ubah Password</h3>
                                <div class="d-flex flex-column">
                                    <form action="" method="post">
                                        @csrf
                                        <div class="d-flex flex-column">
                                            <div class="mb-3"><label for="exampleFormControlInput1 form-control-label" class="form-label">Password Lama</label>
                                                <div class="form-control-container">

                                                    <input required="" name="oldpassword" type="password" class="form-control form-control-inner form-control-lg  form-control  @error('oldpassword') is-invalid @enderror" value="">
                                                    @error('oldpassword')
                                                    <span class="invalid-feedback m-0 " role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="mb-3"><label for="exampleFormControlInput1 form-control-label" class="form-label">Password Baru</label>
                                                <div class="form-control-container"><input required="" name="password" type="password" class="form-control form-control-inner form-control-lg  form-control  @error('password') is-invalid @enderror" value="">

                                                    @error('password')
                                                    <span class="invalid-feedback m-0 " role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-3"><label for="exampleFormControlInput1 form-control-label" class="form-label">Ulangi Password Baru</label>
                                                <div class="form-control-container"><input required="" name="password_confirmation" type="password" class="form-control form-control-inner form-control-lg  form-control  @error('password_confirmation') is-invalid @enderror" value="">
                                                    @error('password_confirmation')
                                                    <span class="invalid-feedback m-0 " role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <button class="btn btn-danger"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="spacer"> </div>

@endsection