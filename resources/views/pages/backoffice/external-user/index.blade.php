@extends('layouts.backoffice')

@section('title', \Request::get('role')=="GURU" ? __("Guru") : (\Request::get('is_pengunjung')==1 ? __("Pengunjung") : __("Siswa")))

@section('header')
  @parent
    <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
            <div class="form-group mb-0">
              <div class="input-group input-group-alternative input-group-merge">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input class="form-control" id="search-dt-table" placeholder="Cari NIS, Nama, Jenjang" type="text">
              </div>
            </div>
            <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main"
              aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </form>
        </div>
        @can('external-user-create')
        <div class="col-lg-6 col-5 text-right">
            <!-- <a href="#" class="btn btn-sm btn-neutral">Filters</a> -->
            @if(\Request::get('role') === 'SISWA' && !@\Request::get('is_pengunjung'))
            <a href="{{ route('backoffice::external-users.next_grade', ['role'=>\Request::get('role')]) }}" class="btn btn-md btn-outline-primary">
              Naik Kelas
            </a>
            <a href="{{ route('backoffice::external-users.batch_create', ['role'=>\Request::get('role')]) }}" class="btn btn-md btn-outline-primary">
              Unggah XLSX
            </a>
            <a href="#" class="btn btn-md btn-secondary">
              Generate QR Code
            </a>
            @endif

            @if(!@\Request::get('is_pengunjung'))
            <a href="{{ route('backoffice::external-users.create', ['role'=>\Request::get('role')]) }}" class="btn btn-md btn-primary">
              <i class="fa fa-plus text-light"></i>&nbsp;&nbsp;Tambah Data
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
    <div class="card bg-transparent">
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
            <x-datatable.table :filterCol="__($col_to_filter)" :isMultiple="__($is_multiple_col)" :customSearch="__(1)">
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