@extends('layouts.frontoffice')

@section('title', __("Video Pembelajaran"))

@section('content')
<section class="mt-4">
	<div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h3>Video Pembelajaran</h3>
            </div>
        </div>
		<div class="row mt-4">
			<!-- nav -->
			<div class="col-md-4">
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
                        <a href="{{ route('app.mapel.modul', $idMapel) }}" class="btn btn-main btn-small w-100 mb-2">
                            Modul Pembelajaran
                        </a>
                        <a href="{{ route('app.mapel.video', $idMapel) }}" class="btn btn-main btn-small w-100 mb-2" style="text-decoration: underline;">
                            Video Pembelajaran
                        </a>
                        <a href="{{ route('app.mapel.simulasi', $idMapel) }}" class="btn btn-main btn-small w-100">
                            Simulasi Pembelajaran
                        </a>
					</div>
				</div>
			</div>
			<!-- videos -->
			<div class="col-md-8">
				<div class="card">
					<div class="card-body" style="height: 500px; overflow: auto;">
						<div class="row">
                            @forelse($videos as $video)
                            <div class="col-md-4 mb-4">
                                <div class="card" style="width: 100%;">
                                    <img class="card-img-top" style="max-height: 140px;" src="{{ @$video->icon ? asset($video->icon) : "https://ideas.or.id/wp-content/themes/consultix/images/no-image-found-360x250.png" }}" alt="{{ @$video->name ?? "-" }}">
                                    <div class="card-body text-center">
                                        <h6 class="card-title">
                                            <a href="{{ route('app.video.detail', @$video->id) }}" style="text-decoration: none;">
                                                {{ @$video->name ?? "-" }}
                                            </a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="ml-1">Belum ada video pembelajaran</div>
                            @endforelse
                            
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection