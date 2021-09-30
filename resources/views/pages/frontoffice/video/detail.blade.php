@extends('layouts.frontoffice')

@section('title', __("Video Detail"))

@section('content')
<section class="mt-4">
	<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-left form-inline">
                    <h3>
                        <!-- <a href="{{ route('app.mapel.video', @$video->mataPelajaran->id) }}">
                            {{ @$video->mataPelajaran->name }}
                        </a> - -->
                        {{ @$video->name }}
                    </h3>
                    <div id="btn-back" class="ml-auto form-inline">
                        @php
                        @$relParam = \Request()->get('rel');
                        @endphp
                        @if($relParam)
                        <a href="{{ url($relParam) }}" class="btn btn-main btn-small">Kembali ke List</a> 
                        @else
                        <a href="{{ route('app.mapel.video', @$video->mataPelajaran->id) }}" class="btn btn-main btn-small">Kembali ke List</a> 
                        @endif
                    </div>
                </div>
                <hr/>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12 text-center">
                <div id="video-detail-fe" video-id="{{ $videoId }}">Loading...</div>
            </div>
        </div>
    </div>
</section>
@endsection