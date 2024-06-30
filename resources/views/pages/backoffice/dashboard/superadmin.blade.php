@extends('layouts.backoffice')

@section('title', 'Dashboard')

@section('header')
  @parent
  <div class="row align-items-center py-4">
    <div class="col-lg-6 col-7">
      <!-- <h6 class="h2 text-dark d-inline-block mb-0">@yield('title')</h6> -->
    </div>
  </div>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header bg-dashboard-welcome" style="border-radius: 14px !important;">
                <div class="text-dashboard-welcome">
                    <h3 class="mb-0 text-primary">
                        Assalamualaikum {{Auth::user()->name}}
                    </h3>
                    <span style="color: #9E9E9E;">Welcome to the Al-Irsyad Edu Monitoring</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="dashboard-superadmin"></div>
@endsection