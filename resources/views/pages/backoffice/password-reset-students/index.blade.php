@extends('layouts.backoffice')

@section('title', __("Reset Password Siswa"))

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
      <div class="">
            <x-datatable.table :customSearch="__(1)">
                {{--
                    data-* is same as option columns in datatable
                    https://datatables.net/reference/option/columns
                --}}
                <th data-data="DT_RowIndex" data-searchable="false">@lang("No")</th>
                <th data-data="nis">@lang("NIS")</th>
                <th data-data="name">@lang("Name")</th>
                <th data-data="status">@lang("Status")</th>
                <th data-data="created_at">@lang("Requested At")</th>
                <th data-data="action" data-orderable="false" data-searchable="false">@lang("Action")</th>
            </x-datatable.table>
        </div>
      <!-- endtble -->
    </div>
  </div>
</div>

@endsection