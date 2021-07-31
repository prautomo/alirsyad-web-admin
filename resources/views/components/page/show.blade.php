@props(['title'])

@extends('layouts.backoffice')

@section('title', $title)

@section('header')
    @parent
    <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0">@yield('title')</h6>
        </div>
        <div class="col-lg-6 col-5 text-right">
            <a href="javascript:history.back()" class="btn btn-sm btn-neutral">Back</a>
        </div>
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                {{$slot}}
            </div>
        </div>
    </div>
</div>
@endsection