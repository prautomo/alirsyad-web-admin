@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Test Payment iPaymu') }}</div>

                <div class="card-body">
                    @if ($errors->any())
                    <x-alert.failed :errors="$errors->all()" />
                    @endif
                    {!! Form::open(array('route' => 'frontoffice::pay.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
                    <select name="paymentMethod" class="form-control">
                        <option value="">Select Payment Method</option>
                        @foreach($paymentMethods as $paymentMethod)
                            <option value="{{ $paymentMethod->id }}">{{ $paymentMethod->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-sm btn-primary">@lang("Pay")</button>
                    {!! Form::close() !!}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection