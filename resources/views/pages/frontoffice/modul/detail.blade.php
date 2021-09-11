@extends('layouts.frontoffice')

@section('title', __("Modul Detail"))

@section('content')
<section class="mt-4">
	<div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div id="modul-detail-fe" 
                    modul-id="{{ $modulId }}"
                    link-modul="{{ route('app.mapel.modul', $mapelId) }}"    
                    link-video="{{ route('app.mapel.video', $mapelId) }}"
                    link-simulasi="{{ route('app.mapel.simulasi', $mapelId) }}"
                >Loading...</div>
            </div>
        </div>
    </div>
</section>
@endsection