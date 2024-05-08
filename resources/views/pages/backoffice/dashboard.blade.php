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
            <div class="card-header border-0">
                <h3 class="mb-0">
                    Welcome {{Auth::user()->name}}
                </h3>
            </div>
        </div>
    </div>
</div>
@endsection