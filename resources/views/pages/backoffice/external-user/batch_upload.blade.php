@extends('layouts.backoffice')

@section('title', __("Batch Upload Siswa"))

@section('header')
  @parent
    <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
            <h6 class="h2 text-dark d-inline-block mb-0">@yield('title')</h6>
        </div>
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div id="uploadsiswa-list"></div>
            </div>
        </div>
    </div>
</div>

@endsection