@extends('layouts.backoffice')

@section('title', __("Modul"))

@section('header')
  @parent
    <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0">@yield('title')</h6>
        </div>
        @can('simulasi-create')
        <div class="col-lg-6 col-5 text-right">
            <a href="{{ route('backoffice::moduls.create') }}" class="btn btn-sm btn-neutral">New</a>
            <!-- <a href="#" class="btn btn-sm btn-neutral">Filters</a> -->
        </div>
        @endcan
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col">
        @if (session('status') === 'success')
            <x-alert.success :message="session('message')" />
        @elseif (session('status') === 'failed')
            <x-alert.failed :message="session('message')" />
        @endif
    <div class="card">
      <!-- Card header -->
      <div class="card-header border-0">
        <h3 class="mb-0">Data</h3>
      </div>
      <!-- tble -->
      <div class="">
            <x-datatable>
                {{--
                    data-* is same as option columns in datatable
                    https://datatables.net/reference/option/columns
                --}}
                <th data-data="DT_RowIndex" data-searchable="false">@lang("No")</th>
                <th data-data="show-img">@lang("Cover")</th>
                <th data-data="name">@lang("Name")</th>
                <th data-data="mapel">@lang("Mata Pelajaran")</th>
                <th data-data="jenjang">@lang("Jenjang")</th>
                <th data-data="tingkat">@lang("Tingkat")</th>
                <!-- <th data-data="created_at">@lang("Created At")</th> -->
                <th data-data="action" data-orderable="false" data-searchable="false">@lang("Action")</th>
            </x-datatable>
        </div>
      <!-- endtble -->
    </div>
  </div>
</div>

@endsection