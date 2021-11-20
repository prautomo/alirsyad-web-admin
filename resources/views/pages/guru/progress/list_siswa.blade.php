@extends('layouts.guru')

@section('title', 'Progres Siswa')

@section('header')
  @parent
  <div class="row align-items-center py-4">
    <div class="col-lg-6 col-7">
      <h6 class="h2 text-white d-inline-block mb-0">@yield('title')</h6>
    </div>
  </div>
@endsection

@section('content')
<!-- detail progress -->
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h3 class="mb-0">
                    Progres Siswa
                </h3>
            </div>
            <div class="card-body">
                <div id="progress-siswa"     
                >Loading...</div>
            </div>
        </div>
    </div>
</div>
@endsection