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
                        @forelse($moduls as $modul)
                            <div class="wrap-kelas row mt-3 ml-1 mr-1" style="padding: 15px 15px 15px 15px !important; cursor: pointer;{{ @\Auth::user()->status !== "AKTIF" && !$modul->is_public ? 'pointer-events:none;' : '' }} " onclick="location.href='{{ route('app.modul.detail', @$modul->slug) }}.html';">
                                
                                <div class="col-md-2 mb-md-1 mb-3 pl-0 pr-0">
                                    <span class="image-cover mr-auto ml-auto">
                                        <img class="card-img-top" style="max-height: auto; height: auto;" src="{{ @$modul->icon ? asset($modul->icon) : '/images/image-placeholder.jpg' }}" alt="{{ @$modul->name ?? "-" }}">
                                    </span>
                                </div>
                                <div class="col-md-10 mt-auto mb-auto">
                                    <h6 class="font-weight-bold text-sm-left text-center">
                                        <a href="{{ route('app.modul.detail', @$modul->slug) }}.html" style="text-decoration: none; {{ @\Auth::user()->status !== "AKTIF" && !$modul->is_public ? 'color:Gray;' : '' }}">
                                            {{ @$modul->name ?? "-" }}
                                        </a>
                                    </h6>
                                    {{-- @if(@$modul->read)
                                        <span class="badge badge-success">Selesai dipelajari</span>
                                    @else
                                        <span class="badge badge-warning">Sedang dipelajari</span>
                                    @endif --}}
                                </div>
                            </div>
                            @empty
                            <div class="ml-1">Belum ada modul pembelajaran</div>
                        @endforelse
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection