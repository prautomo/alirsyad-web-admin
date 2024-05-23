@extends('layouts.backoffice')

@section('title', __("Raport ADL"))

@section('header')
  @parent
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
            <x-datatable.table :customSearch="__(1)">
                {{--
                    data-* is same as option columns in datatable
                    https://datatables.net/reference/option/columns
                --}}
                <th data-data="DT_RowIndex" data-searchable="false">@lang("No")</th>
                <!-- <th data-data="show-img">@lang("Cover")</th> -->
                <th data-data="nis">@lang("NIS")</th>
                <th data-data="name">@lang("Nama")</th>
                <th data-data="jenjang">@lang("Jenjang")</th>
                <th data-data="tingkat">@lang("Tingkat")</th>
                <th data-data="kelas">@lang("Kelas")</th>
                <th data-data="tahun_ajaran">@lang("Tahun Ajaran")</th>
                <th data-data="action" data-orderable="false" data-searchable="false">@lang("Action")</th>
            </x-datatable>
        </div>
      <!-- endtble -->
    </div>
  </div>
</div>

@endsection
