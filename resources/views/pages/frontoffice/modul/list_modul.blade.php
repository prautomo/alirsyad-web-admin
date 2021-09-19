@extends('layouts.frontoffice')

@section('title', __("Modul Pembelajaran"))

@section('content')
<section class="mt-4">
	<div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h3>Modul Pembelajaran</h3>
            </div>
        </div>
		<div class="row mt-4">
			<!-- nav -->
			<div class="col-md-4 mb-4">
				<div class="card">
					<div class="card-body">
						<h5>{{ @$mapel->name ?? '-' }}</h5>
                        <span class="kelas-title">
                            Kelas {{ @$mapel->tingkat->name ?? '-' }} {{ @$mapel->tingkat->jenjang->name }}
                        </span>
					</div>
				</div>
                <br/>
                <div class="card">
					<div class="card-body">
                        <a href="{{ route('app.mapel.modul', $idMapel) }}" class="btn btn-main btn-small w-100 mb-2" style="text-decoration: underline;">
                            Modul Pembelajaran
                        </a>
                        <a href="{{ route('app.mapel.video', $idMapel) }}" class="btn btn-main btn-small w-100 mb-2">
                            Video Pembelajaran
                        </a>
                        <a href="{{ route('app.mapel.simulasi', $idMapel) }}" class="btn btn-main btn-small w-100">
                            Simulasi Pembelajaran
                        </a>
					</div>
				</div>
			</div>
			<!-- moduls -->
			<div class="col-md-8">
				<div class="card">
					<div class="card-body" style="height: 500px; overflow: auto;">
						<div class="row">
                            @forelse($moduls as $modul)
                            <div class="col-md-4 mb-4">
                            <a href="{{ route('app.modul.detail', @$modul->slug) }}.html" style="text-decoration: none;">
                                <div class="card" style="width: 100%;">
                                    <img class="card-img-top" style="max-height: 140px; height: 140px;" src="{{ @$modul->icon ? asset($modul->icon) : '/images/placeholder.png' }}" alt="{{ @$modul->name ?? "-" }}">
                                    <div class="card-body text-center">
                                        <h6 class="card-title">
                                            <a href="{{ route('app.modul.detail', @$modul->slug) }}.html" style="text-decoration: none;">
                                                {{ @$modul->name ?? "-" }}
                                            </a>
                                        </h6>
                                    </div>
                                </div>
                            </a>
                            </div>
                            @empty
                            <div class="ml-1">Belum ada modul pembelajaran</div>
                            @endforelse
                            
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection