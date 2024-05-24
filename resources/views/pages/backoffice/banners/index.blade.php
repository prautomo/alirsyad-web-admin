@extends('layouts.backoffice')

@section('title', __("Banners"))

@section('header')
    @parent
    <div class="d-flex align-items-center">
        <form class="form-inline mr-sm-3 search-main" id="search-main">
            <div class="form-group mb-0">
                <div class="input-group input-group-alternative input-group-merge search-bar-filter">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                    <input class="form-control" id="search-dt-table" placeholder="Cari Judul" type="text">
                </div>
            </div>
        </form>

        @can('banner-create')
        <div style="margin-left: auto;">
            <a href="{{ route('backoffice::banners.create') }}" class="btn btn-md btn-primary">
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
      <div class="table-responsive">
            <x-datatable.table :customSearch="__(1)">
                {{--
                    data-* is same as option columns in datatable
                    https://datatables.net/reference/option/columns
                --}}
                <th data-data="show-img">@lang("Image")</th>
                <th data-data="title">@lang("Title")</th>
                <th data-data="status">@lang("Status")</th>
                <th data-data="created_at">@lang("Created At")</th>
                <th data-data="action" data-orderable="false" data-searchable="false">@lang("Action")</th>
            </x-datatable.table>
        </div>
      <!-- endtble -->
    </div>
  </div>
</div>

@endsection