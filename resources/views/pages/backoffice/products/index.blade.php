@extends('layouts.backoffice')

@section('title', __("Products ".$user->name))

@section('header')
  @parent
    <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0">@yield('title')</h6>
        </div>
        <!-- @can('product-create')
        <div class="col-lg-6 col-5 text-right">
            <a href="{{ route('backoffice::products.create', ['userId' => $userId]) }}" class="btn btn-sm btn-neutral">New</a>
        </div>
        @endcan -->
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
                <th data-data="name">@lang("Product Name")</th>
                <th data-data="category">@lang("Category")</th>
                <th data-data="price">@lang("Price")</th>
                <th data-data="discount">@lang("Discount")</th>
                <th data-data="selling_price">@lang("Selling Price")</th>
                <th data-data="unit">@lang("Unit")</th>
                <!-- <th data-data="action">@lang("Action")</th> -->
            </x-datatable>
        </div>
      <!-- endtble -->
    </div>
  </div>
</div>

@endsection