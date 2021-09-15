@extends('layouts.frontoffice')

@section('title', __("Video Detail"))

@section('content')
<section class="mt-4">
	<div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>{{ @$video->name }}</h3>
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