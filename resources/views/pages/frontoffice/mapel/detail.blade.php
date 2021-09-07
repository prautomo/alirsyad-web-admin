@extends('layouts.frontoffice')

@section('title', __("Mata Pelajaran"))

@section('content')
<section class="mt-4">
	<div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h3>{{ @$mapel->name ?? "-" }}</h3>
                <span class="kelas-title">
                    Kelas {{ $mapel->kelas->name ?? "-" }} {{ @$mapel->kelas->tingkat->name }}
                </span>
            </div>
        </div>
		<div class="row mt-4">
			<!-- sedang dipelajari -->
			<div class="col-md-6">
				<div class="card">
					<div class="card-body">
						<div class="card-title">
							Program Belajar Matematika
						</div>
						<hr/>
						<div class="wrap-kelas form-inline mt-3">
							<div>
								<h4 class="font-weight-300">Modul</h4>
							</div>
							<div class="ml-auto">
                                <div class="progress">
                                    <div class="progress-bar" style="width:70%"></div>
                                  </div> 
							</div>
						</div>

						
						<div class="wrap-kelas form-inline mt-3">
							<div>
								<h4 class="font-weight-300">Video</h4>
							</div>
							<div class="ml-auto">
                                <div class="progress">
                                    <div class="progress-bar" style="width:70%"></div>
                                  </div> 
							</div>
						</div>

						
						<div class="wrap-kelas form-inline mt-3">
							<div>
								<h4 class="font-weight-300">Simulasi</h4>
							</div>
							<div class="ml-auto">
                                <div class="progress">
                                    <div class="progress-bar" style="width:70%"></div>
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
						<div class="card-title">
							Lanjut Belajar
						</div>
						<hr/>
						<div class="wrap-kelas form-inline mt-3">
							<div>
								<h4 class="font-weight-bold mt-auto mb-auto">Modul Pembelajaran</h4>
							</div>
							<div class="ml-auto">
								<button class="btn btn-main btn-small">
									Akses
								</button>
							</div>
						</div>

                        <div class="wrap-kelas form-inline mt-3">
							<div>
								<h4 class="font-weight-bold mt-auto mb-auto">Video Pembelajaran</h4>
							</div>
							<div class="ml-auto">
								<button class="btn btn-main btn-small">
									Akses
								</button>
							</div>
						</div>

                        <div class="wrap-kelas form-inline mt-3">
							<div>
								<h4 class="font-weight-bold mt-auto mb-auto">Simulasi Pembelajaran</h4>
							</div>
							<div class="ml-auto">
								<button class="btn btn-main btn-small">
									Akses
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection