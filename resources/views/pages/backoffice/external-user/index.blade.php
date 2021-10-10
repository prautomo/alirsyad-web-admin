@extends('layouts.backoffice')

@section('title', __("External Users"))

@section('header')
  @parent
    <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0">@yield('title')</h6>
        </div>
        @can('external-user-create')
        <div class="col-lg-6 col-5 text-right">
            @if(!@\Request::get('is_pengunjung'))
            <a href="{{ route('backoffice::external-users.create', ['role'=>\Request::get('role')]) }}" class="btn btn-sm btn-neutral">New</a>
            @endif
            <!-- <a href="#" class="btn btn-sm btn-neutral">Filters</a> -->
            @if(\Request::get('role') === 'SISWA' && !@\Request::get('is_pengunjung'))
            <a href="{{ route('backoffice::external-users.batch_create', ['role'=>\Request::get('role')]) }}" class="btn btn-sm btn-primary">
              Import dari Excel
            </a>
            @endif
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
                <!-- <th data-data="show-img">@lang("Image")</th> -->
                @if(\Request::get('role') === 'SISWA')
                <th data-data="nis">@lang("NIS")</th>
                @else
                <th data-data="nis">@lang("NIP")</th>
                @endif
                <th data-data="name">@lang("Name")</th>
                @if(\Request::get('role') === 'SISWA' && !@\Request::get('is_pengunjung'))
                <th data-data="kelas.tingkat.jenjang.name">@lang("Jenjang")</th>
                <th data-data="kelas.tingkat.name">@lang("Tingkat")</th>
                <th data-data="kelas.name">@lang("Kelas")</th>
                @elseif(\Request::get('role') === 'SISWA' && @\Request::get('is_pengunjung'))
                <th data-data="jenjang.name">@lang("Jenjang")</th>
                @else
                <th data-data="mengajar">@lang("Mengajar")</th>
                @endif
                <th data-data="show-status">@lang("Status")</th>
                <th data-data="action" data-orderable="false" data-searchable="false">@lang("Action")</th>
            </x-datatable>
        </div>
      <!-- endtble -->
    </div>
  </div>
</div>

@endsection