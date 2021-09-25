@extends('layouts.frontoffice')

@section('title', __("Edit Password"))

@section('content')
<section class="mt-4">
	<div class="container">
        <div class="row mb-2">
            <div class="col-md-12 text-left">
                <h3>Ubah Profile</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
            <div class="card text-left pl-3 pr-3">

                <div class="card-body pl-1 pr-1">
                    <div style="background-color: transparent;">
                        <div class="d-flex flex-column">
                            <form action="" method="post">
                                @csrf
                                <div class="d-flex flex-column">
                                    
                                    <div class="mb-3"><label for="exampleFormControlInput1 form-control-label" class="form-label">Email</label>
                                        <div class="form-control-container"><input required="" name="email" type="email" class="form-control form-control-inner form-control-lg  form-control  @error('email') is-invalid @enderror" value="">

                                            @error('email')
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

@endsection