@extends('layouts.frontoffice')

@section('title', __("Simulasi Pembelajaran"))

@section('content')
<section class="mt-4">
	<div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h3>Simulasi Pembelajaran</h3>
            </div>
        </div>
		<div class="row mt-4">
			<!-- nav -->
			<div class="col-md-4 mb-4">
				<div class="card">
					<div class="card-body">
                        <h5>
                            <a href="{{ route('app.mapel.detail', @$idMapel) }}" style="">
                                {{ @$mapel->name ?? '-' }}
                            </a>
                        </h5>
                        <span class="kelas-title">
                            Kelas {{ @$mapel->tingkat->name ?? '-' }} {{ @$mapel->tingkat->jenjang->name }}
                        </span>
					</div>
				</div>
                <br/>
                <div class="card">
					<div class="card-body">
                        <a href="{{ route('app.mapel.modul', $idMapel) }}" class="btn btn-main btn-small w-100 mb-2">
                            Modul Pembelajaran
                        </a>
                        <a href="{{ route('app.mapel.video', $idMapel) }}" class="btn btn-main btn-small w-100 mb-2">
                            Video Pembelajaran
                        </a>
                        <a href="{{ route('app.mapel.simulasi', $idMapel) }}" class="btn btn-main btn-small w-100" style="text-decoration: underline;">
                            Simulasi Pembelajaran
                        </a>
					</div>
				</div>
			</div>
			<!-- simulasis -->
			<div class="col-md-8">
				<div class="card">
					<div class="card-body" style="height: 500px; overflow: auto;">
                        @forelse($simulasis as $simulasi)

                            <div class="wrap-kelas row mt-3 ml-1 mr-1" 
                                @if(!@$simulasi->disabled)
                                style="padding: 15px 15px 15px 15px !important; cursor: pointer;" 
                                onclick="location.href='{{ route('app.simulasi.detail', @$simulasi->slug) }}.html';"
                                @else
                                style="padding: 15px 15px 15px 15px !important;" 
                                @endif
                            >
                                
                                <div class="col-md-2 mb-md-1 mb-3 pl-0 pr-0">
                                    <span class="image-cover mr-auto ml-auto">
                                        <img class="card-img-top" style="max-height: auto; height: auto;" src="{{ @$simulasi->icon ? asset($simulasi->icon) : '/images/image-placeholder.jpg' }}" alt="{{ @$simulasi->name ?? "-" }}">

                                        <div class="rating-simulasi-star text-center">
                                            @php
                                            $rataRataScore = @$simulasi->rata_rata_score ?? 0;
                                            @endphp
                                            <span class="fa fa-star{{ ($rataRataScore>=33) ? ' checked' : '' }}"></span>
                                            <span class="fa fa-star{{ ($rataRataScore>=66) ? ' checked' : '' }}"></span>
                                            <span class="fa fa-star{{ ($rataRataScore>=99) ? ' checked' : '' }}"></span>
                                        </div>
                                    </span>
                                </div>
                                <div class="col-md-10 my-auto">
                                    <h6 class="font-weight-bold text-sm-left text-center mb-0">
                                        @if(!@$simulasi->disabled)
                                        <a href="{{ route('app.simulasi.detail', @$simulasi->slug) }}.html" style="text-decoration: none;">
                                            {{ @$simulasi->name ?? "-" }}
                                        </a>
                                        @else
                                        <span style="text-decoration: none;" class="disable">
                                            {{ @$simulasi->name ?? "-" }}
                                        </span>
                                        @endif
                                    </h6>
                                    <span style="font-size: 14px; font-weight: 300;">Level {{ @$simulasi->level ?? 1}}</span>
                                    
                                    @if(@$simulasi->played)
                                        <small class="badge badge-success">Sudah dikerjakan</small>
                                    @else
                                        <small class="badge badge-warning">Belum pernah dikerjakan.</small>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="ml-1">Belum ada simulasi pembelajaran</div>
                        @endforelse
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection

@push('style')
<style>
    
</style>
@endpush