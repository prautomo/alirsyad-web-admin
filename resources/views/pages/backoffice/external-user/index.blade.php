@extends('layouts.backoffice')

@section('title', \Request::get('role')=="GURU" ? __("Guru") : (\Request::get('is_pengunjung')==1 ? __("Pengunjung") : __("Siswa")))

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
            <a href="{{ route('backoffice::external-users.batch_create', ['role'=>\Request::get('role')]) }}" class="btn btn-sm btn-info">
              Import dari Excel
            </a>
            <a href="{{ route('backoffice::external-users.next_grade', ['role'=>\Request::get('role')]) }}" class="btn btn-sm btn-primary">
              Naik Kelas
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
          
            @php
              $col_to_filter = "";
              $is_multiple_col = "";
              if(\Request::get('role') == "GURU"){
                $col_to_filter = "3";
                $is_multiple_col = "1";
              }else if(\Request::get('role') == "SISWA" && \Request::get('is_pengunjung') == 0){
                $col_to_filter = "6,5,4,3";
                $is_multiple_col = "0,0,0,0";
              }else if(\Request::get('role') == "SISWA" && \Request::get('is_pengunjung') == 1){
                $col_to_filter = "3";
                $is_multiple_col = "0";
              }
            @endphp
            <p></p>
            <x-datatable.table :filterCol="__($col_to_filter)" :isMultiple="__($is_multiple_col)">
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
                <th data-data="tahun_ajaran">@lang("Tahun Ajaran")</th>
                @elseif(\Request::get('role') === 'SISWA' && @\Request::get('is_pengunjung'))
                <th data-data="jenjang.name">@lang("Jenjang")</th>
                @else
                <th data-data="mengajar">@lang("Mengajar")</th>
                @endif
                <th data-data="show-status">@lang("Status")</th>
                <th data-data="action" data-orderable="false" data-searchable="false">@lang("Action")</th>
            </x-datatable.table>
        </div>
      <!-- endtble -->
    </div>
  </div>
</div>

@endsection