@props(['title'])

@extends('layouts.backoffice')

@section('title', $title)

@section('header')
  @parent
    <div class="d-flex align-items-center">
        <div style="margin-left: auto;">
            <!-- <a href="" class="btn btn-md btn-secondary">
                Kembali
            </a> -->
        </div>
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
        @if ($errors->any())
        <x-alert.failed :errors="$errors->all()" />
        @endif
        <div class="card bg-transparent">
            <div class="card-body">
                {{$slot}}
            </div>
        </div>
    </div>
</div>
@endsection