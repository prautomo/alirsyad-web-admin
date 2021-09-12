@extends('layouts.guru')

@section('title', 'Dashboard')

@section('header')
  @parent
  <div class="row align-items-center py-4">
    <div class="col-lg-6 col-7">
      <h6 class="h2 text-white d-inline-block mb-0">@yield('title')</h6>
    </div>
  </div>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header border-0">
                <h3 class="mb-0">
                    Progress Belajar
                </h3>
            </div>
            <div class="card-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#matematika1">Matematika 1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#matematika2">Matematika 2</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane container active" id="matematika1">
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center bg-grey rounded bg-modul">
                                        <h4>Rata-rata Progress Modul</h4>
                                        <h1 class="progress-value">7/10</h1>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center bg-grey rounded bg-video">
                                        <h4>Rata-rata Progress Video</h4>
                                        <h1 class="progress-value">7/10</h1>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center bg-grey rounded bg-simulasi">
                                        <h4>Rata-rata Progress Simulasi</h4>
                                        <h1 class="progress-value">7/10</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane container fade" id="matematika2">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- detail progress -->
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header border-0">
                <h3 class="mb-0">
                    Detail Progress Belajar
                </h3>
            </div>
            <div class="card-body">
                
            </div>
        </div>
    </div>
</div>
@endsection