@extends('layouts.frontoffice')

@section('title', __("Mata Pelajaran"))

@section('content')
<section class="mt-4">
	<div class="container">

        @if(!@\Auth::user()->is_pengunjung)
		<div class="row mt-4">
			<!-- sedang dipelajari -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="card-title">
							Mata Pelajaran yang Sedang Dipelajari
						</div>
						<hr/>
						
                        <div style="max-height: 500px; overflow: auto;">

                            @forelse($sedangDipelajari as $sedangDipelajari)
                            <div class="wrap-kelas form-inline mt-3">
                                <div>
                                    <span class="kelas-title">
                                        Kelas {{ @$sedangDipelajari->tingkat->name ?? '-' }} {{ @$sedangDipelajari->tingkat->jenjang->name }}
                                    </span>
                                    <h4 class="font-weight-bold">
                                        {{ @$sedangDipelajari->name ?? "-" }}
                                    </h4>
                                </div>
                                <div class="ml-auto">
                                    <a href="{{ route('app.mapel.detail', @$sedangDipelajari->id) }}" class="btn btn-small btn-main">
                                        <i class="btn-icon fa fa-play ml-2"></i> Lanjut Belajar
                                    </a>
                                </div>
                            </div>
                            @empty
                            <div class="wrap-kelas form-inline mt-3">
                                <h4 class="font-weight-bold">Belum ada mata pelajaran.</h4>
                            </div>
                            @endforelse
    
                        </div>

					</div>
				</div>
			</div>
			
		</div>

        <!-- sudah dipelajari -->
        <!-- <div class="row mt-4">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="card-title">
							Mata Pelajaran yang Sudah Dipelajari
						</div>
						<hr/>
						
                        <div style="max-height: 500px; overflow: auto;">

                            @forelse($sebelumnya as $sebelumnya)
                            <div class="wrap-kelas form-inline mt-3">
                                <div>
                                    <span class="kelas-title">
                                        Kelas {{ @$sebelumnya->tingkat->name ?? '-' }} {{ @$sebelumnya->tingkat->jenjang->name }}
                                    </span>
                                    <h4 class="font-weight-bold">
                                        {{ @$sebelumnya->name ?? "-" }}
                                    </h4>
                                </div>
                                <div class="ml-auto">
                                    <a href="{{ route('app.mapel.detail', @$sebelumnya->id) }}" class="btn btn-small btn-main">
                                        <i class="btn-icon fa fa-play ml-2"></i> Lanjut Belajar
                                    </a>
                                </div>
                            </div>
                            @empty
                            <div class="wrap-kelas form-inline mt-3">
                                <h4 class="font-weight-bold">Belum ada mata pelajaran.</h4>
                            </div>
                            @endforelse
    
                        </div>

					</div>
				</div>
			</div>
			
		</div> -->
        <!-- end sudah dipelajari -->

        <!-- yg akan dipelajari -->
        <!-- <div class="row mt-4">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="card-title">
							Mata Pelajaran yang Akan Datang
						</div>
						<hr/>
						
                        <div style="max-height: 500px; overflow: auto;">

                            @forelse($yangAkanDatang as $yangAkanDatang)
                            <div class="wrap-kelas form-inline mt-3">
                                <div>
                                    <span class="kelas-title disable">
                                        Kelas {{ @$yangAkanDatang->tingkat->name ?? '-' }} {{ @$yangAkanDatang->tingkat->jenjang->name }}
                                    </span>
                                    <h4 class="font-weight-bold disable">
                                        {{ @$yangAkanDatang->name ?? "-" }}
                                    </h4>
                                </div>
                            </div>
                            @empty
                            <div class="wrap-kelas form-inline mt-3">
                                <h4 class="font-weight-bold">Belum ada mata pelajaran.</h4>
                            </div>
                            @endforelse
    
                        </div>

					</div>
				</div>
			</div>
			
		</div> -->
        <!-- end yg akan dipelajari -->
        @else

        <div class="row mt-4">
			<!-- mapel aktif by admin -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="card-title">
							Mata Pelajaran Aktif
						</div>
						<hr/>
						
                        <div style="max-height: 500px; overflow: auto;">

                            @forelse($aktif as $mpa)
                            <div class="wrap-kelas form-inline mt-3">
                                <div>
                                    <span class="kelas-title">
                                        Kelas {{ @$mpa->tingkat->name ?? '-' }} {{ @$mpa->tingkat->jenjang->name }}
                                    </span>
                                    <h4 class="font-weight-bold">
                                        {{ @$mpa->name ?? "-" }}
                                    </h4>
                                </div>

                                <div class="ml-auto">
                                    <a href="{{ route('app.mapel.detail', @$mpa->id) }}" class="btn btn-main btn-small">
                                        <i class="btn-icon fa fa-play ml-2"></i> Lanjut Belajar
                                    </a>
                                </div>
                            </div>
                            @empty
                            <div class="wrap-kelas form-inline mt-3">
                                <h4 class="font-weight-bold">Belum ada mata pelajaran.</h4>
                            </div>
                            @endforelse
    
                        </div>

					</div>
				</div>
			</div>
			
		</div>

        <div class="row mt-4">
			<!-- mapel yang tidak dipilih admin -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="card-title">
							Mata Pelajaran Tidak Aktif
						</div>
						<hr/>
						
                        <div style="max-height: 500px; overflow: auto;">

                            @forelse($tidakAktif as $mpta)
                            <div class="wrap-kelas form-inline mt-3">
                                <div>
                                    <span class="kelas-title disable">
                                        Kelas {{ @$mpta->tingkat->name ?? '-' }} {{ @$mpta->tingkat->jenjang->name }}
                                    </span>
                                    <h4 class="font-weight-bold disable">
                                        {{ @$mpta->name ?? "-" }}
                                    </h4>
                                </div>
                            </div>
                            @empty
                            <div class="wrap-kelas form-inline mt-3">
                                <h4 class="font-weight-bold">Belum ada mata pelajaran.</h4>
                            </div>
                            @endforelse
    
                        </div>

					</div>
				</div>
			</div>
			
		</div>
        @endif
	</div>
</section>
@endsection