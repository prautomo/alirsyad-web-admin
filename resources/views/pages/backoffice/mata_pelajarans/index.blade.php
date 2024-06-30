@extends('layouts.backoffice')

@section('title', __("Mata Pelajaran"))

@section('header')
    @parent
    <div class="d-flex align-items-center">
        <form class="form-inline mr-sm-3 search-main" id="search-main">
            <div class="form-group mb-0">
                <div class="input-group input-group-alternative input-group-merge search-bar-filter">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                    <input class="form-control" id="search-dt-table" placeholder="Cari Nama, Jenjang Pendidikan, Tingkat" type="text">
                </div>
            </div>
        </form>

        <div class="dropdown mr-3">
            <button class="btn btn-green-pastel dropdown-toggle" type="button" data-toggle="modal" data-target="#filterModal" aria-haspopup="true" aria-expanded="false">
            {{__("Filter")}}
            </button>
        </div>

        @can('mata_pelajaran-create')
        <div style="margin-left: auto;">
            <a href="{{ route('backoffice::mata_pelajarans.create') }}" class="btn btn-md btn-primary">
                <i class="fa fa-plus text-light"></i>&nbsp;&nbsp;Tambah Data
            </a>
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
            <x-datatable.table :filterCol="__('4,3,2')" :isMultiple="__('0,0,0')" :customSearch="__(1)">
                {{--
                    data-* is same as option columns in datatable
                    https://datatables.net/reference/option/columns
                --}}
                <th data-data="DT_RowIndex" data-searchable="false">@lang("No")</th>
                <th data-data="show-img">@lang("Cover")</th>
                <th data-data="name">@lang("Name")</th>
                <th data-data="jenjang">@lang("Jenjang Pendidikan")</th>
                <th data-data="tingkat">@lang("Tingkat")</th>
                <th data-data="created_at">@lang("Created At")</th>
                <th data-data="action" data-orderable="false" data-searchable="false">@lang("Action")</th>
            </x-datatable.table>
        </div>
      <!-- endtble -->
    </div>
  </div>
</div>

@endsection