@extends('layouts.backoffice')

@section('title', __("Articles"))

@section('header')
  @parent
    <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
            <h6 class="h2 text-dark d-inline-block mb-0">@yield('title')</h6>
        </div>
        @can('article-create')
        <div class="col-lg-6 col-5 text-right">
            <a href="{{ route('backoffice::articles.create') }}" class="btn btn-sm btn-neutral">New</a>
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
      <div class="table-responsive">
            <x-datatable>
                {{--
                    data-* is same as option columns in datatable
                    https://datatables.net/reference/option/columns
                --}}
                <th data-data="show-img">@lang("Image")</th>
                <th data-data="title">@lang("Title")</th>
                <th data-data="author">@lang("Author")</th>
                <th data-data="created_at">@lang("Created At")</th>
                <th data-data="updated_at">@lang("Updated At")</th>
                <th data-data="action" data-orderable="false" data-searchable="false">@lang("Action")</th>
            </x-datatable>
        </div>
      <!-- endtble -->
    </div>
  </div>
</div>

@endsection