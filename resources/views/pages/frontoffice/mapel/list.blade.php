@extends('layouts.frontoffice')

@section('title', __("Mata Pelajaran"))

@section('content')
<section class="mt-4">
	<div class="container">
		<div class="row mt-4">
			<!-- sedang dipelajari -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="card-title">
							Mata Pelajaran yang Sedang Dipelajari
						</div>
						<hr/>
						
                        <div style="height: 500px; overflow: auto;">

                            @forelse($sedangDipelajari as $sedangDipelajari)
                            <div class="wrap-kelas form-inline mt-3">
                                <div>
                                    <span class="kelas-title">
                                        Kelas {{ $sedangDipelajari->kelas->name ?? "-" }} {{ @$sedangDipelajari->kelas->tingkat->name }}
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
	</div>
</section>
@endsection