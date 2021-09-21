@extends('layouts.frontoffice')

@section('title', __("Simulasi Detail"))

@section('content')
<section class="mt-4">
	<div class="container">
        <div class="row mb-2">
            <div class="col-md-12 text-left">
                <div class="text-left form-inline">
                    <h3>
                        <!-- <a href="{{ route('app.mapel.simulasi', @$simulasi->mata_pelajaran_id) }}" style="text-decoration: none;">
                            {{ @$simulasi->mataPelajaran->name }}
                        </a> :  -->
                        {{ @$simulasi->name }}
                    </h3>
                    <div id="btn-back" class="ml-auto form-inline">
                        <a href="{{ route('app.mapel.simulasi', @$simulasi->mata_pelajaran_id) }}" class="btn btn-main btn-small">Kembali ke List</a> 
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <iframe 
                    src="{{ asset(@$simulasi->path_simulasi.'/index.html') }}" 
                    style="height:550px;width:100%;"
                    title="{{ @$simulasi->name }}"></iframe> 
            </div>
        </div>
    </div>
</section>
@endsection