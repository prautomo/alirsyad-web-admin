@extends('layouts.frontoffice')

@section('title', __("Mata Pelajaran"))

@section('content')
<section class="mt-4">
	<div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h3>{{ @$mapel->name ?? "-" }}</h3>
                <span class="kelas-title">
					Kelas {{ @$mapel->tingkat->name ?? '-' }} {{ @$mapel->tingkat->jenjang->name }}
                </span>
            </div>
        </div>
		<div class="row mt-4">
			<!-- sedang dipelajari -->
			<div class="col-md-6">
				<div class="card">
					<div class="card-body">
						<div class="card-title mb-0 form-inline">
							<i class="ni ni-check-bold icon-title"></i>
							<div>Program Belajar {{ @$mapel->name ?? "-" }}</div>
						</div>
						<hr/>
						<div class="wrap-kelas row mt-3 ml-1 mr-1">
							<div class="col-md-4">
								<h4 class="font-weight-300">Modul</h4>
							</div>
							<div class="col-md-8">
                                <div class="d-block w-100">
                                    <div class="progress" title="{{ @$progress['progress_modul']['done'] ?? 0 }} / {{ @$progress['progress_modul']['total'] ?? 0 }}">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="{{ @$progress['progress_modul']['percentage'] ?? 0 }}" aria-valuemin="0" aria-valuemax="{{ @$progress['progress_modul']['percentage'] ?? 0 }}" style="width: {{ @$progress['progress_modul']['percentage'] ?? 0 }}%; background-color: rgb(52, 125, 241);"></div>
                                    </div>
                                    <div class="" style="font-size: 0.8rem;">
                                        <span>{{ round((@$progress['progress_modul']['percentage'] ?? 0), 2) }}% selesai</span>
                                    </div>
                                </div>
							</div>
						</div>
						
						<div class="wrap-kelas row mt-3 ml-1 mr-1">
							<div class="col-md-4">
								<h4 class="font-weight-300">Video</h4>
							</div>
							<div class="col-md-8">
                                <div class="d-block w-100">
                                    <div class="progress" title="{{ @$progress['progress_video']['done'] ?? 0 }} / {{ @$progress['progress_video']['total'] ?? 0 }}">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="{{ @$progress['progress_video']['percentage'] ?? 0 }}" aria-valuemin="0" aria-valuemax="{{ @$progress['progress_video']['percentage'] ?? 0 }}" style="width: {{ @$progress['progress_video']['percentage'] ?? 0 }}%; background-color: rgb(52, 125, 241);"></div>
                                    </div>
                                    <div class="" style="font-size: 0.8rem;">
                                        <span>{{ round((@$progress['progress_video']['percentage'] ?? 0), 2) }}% selesai</span>
                                    </div>
                                </div>
							</div>
						</div>
						
						<div class="wrap-kelas row mt-3 ml-1 mr-1">
							<div class="col-md-4">
								<h4 class="font-weight-300">Simulasi</h4>
							</div>
							<div class="col-md-8">
                                <div class="d-block w-100">
                                    <div class="progress" title="{{ @$progress['progress_simulasi']['done'] ?? 0 }} / {{ @$progress['progress_simulasi']['total'] ?? 0 }}">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="{{ @$progress['progress_simulasi']['percentage'] ?? 0 }}" aria-valuemin="0" aria-valuemax="{{ @$progress['progress_simulasi']['percentage'] ?? 0 }}" style="width: {{ @$progress['progress_simulasi']['percentage'] ?? 0 }}%; background-color: rgb(52, 125, 241);"></div>
                                    </div>
                                    <div class="" style="font-size: 0.8rem;">
                                        <span>{{ round((@$progress['progress_simulasi']['percentage'] ?? 0), 2) }}% selesai</span>
                                    </div>
                                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- akan datang -->
			<div class="col-md-6">
				<div class="card">
					<div class="card-body">
						<div class="card-title mb-0 form-inline">
							<i class="ni ni-books icon-title"></i>
							<div>Lanjut Belajar</div>
						</div>
						<hr/>
						<div class="wrap-kelas form-inline mt-3">
							<div>
								<h4 class="font-weight-bold mt-auto mb-auto">Modul Pembelajaran</h4>
							</div>
							<div class="ml-auto">
								<a href="{{ route('app.mapel.modul', @$mapelId) }}" class="btn btn-main btn-small">
									Akses
								</a>
							</div>
						</div>

                        <div class="wrap-kelas form-inline mt-3">
							<div>
								<h4 class="font-weight-bold mt-auto mb-auto">Video Pembelajaran</h4>
							</div>
							<div class="ml-auto">
								<a href="{{ route('app.mapel.video', @$mapelId) }}" class="btn btn-main btn-small">
									Akses
								</a>
							</div>
						</div>

                        <div class="wrap-kelas form-inline mt-3">
							<div>
								<h4 class="font-weight-bold mt-auto mb-auto">Simulasi Pembelajaran</h4>
							</div>
							<div class="ml-auto">
								<a href="{{ route('app.mapel.simulasi', @$mapelId) }}" class="btn btn-main btn-small">
									Akses
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection