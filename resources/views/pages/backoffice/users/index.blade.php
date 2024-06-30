@extends('layouts.backoffice')

@section('title', \Request::get('role')=="Guru" ? __("Guru Uploader") : __("Superadmin"))

@section('header')
    @parent
    <div class="d-flex align-items-center">
        <form class="form-inline mr-sm-3 search-main" id="search-main">
            <div class="form-group mb-0">
                <div class="input-group input-group-alternative input-group-merge search-bar-filter">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                    <input class="form-control" id="search-dt-table" placeholder="Cari Nama" type="text">
                </div>
            </div>
        </form>

        @can('user-create')
        @if(@strtolower(\Request::get('role')) !== 'guru')
        <div style="margin-left: auto;">
            <a href="{{ route('backoffice::users.create') }}" class="btn btn-md btn-primary">
                <i class="fa fa-plus text-light"></i>&nbsp;&nbsp;Tambah Data
            </a>
        </div>
        @endif
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
            <!-- table -->
            <div class="">
                <x-datatable.table :customSearch="__(1)">
                    {{--
                        data-* is same as option columns in datatable
                        https://datatables.net/reference/option/columns
                    --}}
                    <th data-data="DT_RowIndex" data-searchable="false">@lang("No")</th>
                    <th data-data="name" data-orderable="true" data-searchable="true">@lang("Name")</th>
                    <th data-data="roles" data-orderable="false" data-searchable="false">@lang("Roles")</th>
                    <!-- <th data-data="uploader">@lang("Uploader")</th> -->
                    @if(\Request::get('role') === 'Guru')
                    <th data-data="mapel">@lang("Mata Pelajaran")</th>
                    @endif
                    <!-- <th data-data="created_at" data-searchable="false">@lang("Created At")</th> -->\
                    @if(\Request::get('role') === 'Superadmin')
                    <th data-data="action" data-orderable="false" data-searchable="false">@lang("Action")</th>
                    @endif
                </x-datatable.table>
            </div>
            <!-- endtable -->
        </div>
    </div>
</div>

@endsection