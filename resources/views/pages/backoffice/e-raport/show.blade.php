@extends('layouts.backoffice')

@section('title', __("Raport ADL"))

@section('header')
  @parent
  <style>
    .row-student-info{
      padding: 0.8rem 1.5rem;
      background: #023402;
      color: white;
      border-radius: 5px;
      text-align: center;
      font-weight: 700;
    }
  </style>
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
        
        <div class="row row-student-info">
          <div class="col-3">
            {{ $user->name }}
          </div>
          <div class="col-2">
            {{ $user->kelas->tingkat->jenjang->name }}
          </div>
          <div class="col-2">
            {{ $user->kelas->tingkat->name }}
          </div>
          <div class="col-2">
            {{ $user->kelas->name }}
          </div>
          <div class="col-3">
            {{ $user->tahun_ajaran }}
          </div>
        </div>
        <x-datatable.table :customSearch="__(1)">
            {{--
                data-* is same as option columns in datatable
                https://datatables.net/reference/option/columns
            --}}
            <th data-data="name">@lang("Mata Pelajaran")</th>
            <th data-data="jumlah_bab">@lang("Jumlah Bab")</th>
            <th data-data="jumlah_subbab">@lang("Jumlah Sub Bab")</th>
            <th data-data="final_score">@lang("Final Score")</th>
            <th data-data="action" data-orderable="false" data-searchable="false">@lang("Action")</th>
        </x-datatable>
      </div>
      <!-- endtble -->
    </div>
  </div>
</div>

@endsection
