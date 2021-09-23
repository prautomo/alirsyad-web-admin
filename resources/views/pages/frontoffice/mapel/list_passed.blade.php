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
							Mata Pelajaran Sebelumnya
						</div>
						<hr/>
						
                        <div style="max-height: 500px; overflow: auto;">

                            @forelse($sebelumnya as $mapel)
                            <div class="wrap-kelas form-inline mt-3">
                                <div>
                                    <span class="kelas-title">
                                        Kelas {{ @$mapel->tingkat->name ?? '-' }} {{ @$mapel->tingkat->jenjang->name }}
                                    </span>
                                    <h4 class="font-weight-bold">
                                        {{ @$mapel->name ?? "-" }}
                                    </h4>
                                </div>
                                <div class="ml-auto">
                                    <a href="{{ route('app.mapel.detail', @$mapel->id) }}" class="btn btn-small btn-main">
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