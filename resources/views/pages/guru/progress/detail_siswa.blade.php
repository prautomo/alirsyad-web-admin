@extends('layouts.guru')

@section('title', 'Detail Siswa')

@section('header')
  @parent
  <div class="row align-items-center py-4">
    <div class="col-lg-6 col-7">
      <h6 class="h2 text-dark d-inline-block mb-0">@yield('title')</h6>
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
                    Progres Siswa - {{ @$siswa->name }} ({{ @$mataPelajaran->name }})
                </h3>
            </div>
            <div class="card-body">
                <div id="progress-detail-siswa"
                    mapel-id="{{ @$mataPelajaran->id }}"
                    siswa-id="{{ @$siswa->id }}"        
                >Loading...</div>
            </div>
        </div>
    </div>
</div>
@endsection