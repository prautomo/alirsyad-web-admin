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
                        @php
                        @$relParam = \Request()->get('rel');
                        @endphp
                        @if($relParam)
                        <a href="{{ url($relParam) }}" class="btn btn-main btn-small">Kembali ke List</a> 
                        @else
                        <a href="{{ route('app.mapel.simulasi', @$simulasi->mata_pelajaran_id) }}" class="btn btn-main btn-small">Kembali ke List</a> 
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <iframe 
                    id="simulasi-frame" 
                    style="height:550px;width:100%;"
                    title="{{ @$simulasi->name }}"></iframe> 
            </div>
        </div>
    </div>
</section>
@endsection

@push("script")
<script>
    $(function(){
        var token = window.localStorage.getItem('token');

        $("#simulasi-frame").prop('src', "{{ asset(@$simulasi->path_simulasi.'/index.html?simulasi_id='.@$simulasi->id) }}&url={{ url('/api/simulasis') }}/&token="+token);
    });
</script>
@endpush