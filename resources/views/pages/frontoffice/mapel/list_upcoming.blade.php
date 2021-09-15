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
							Mata Pelajaran yang Akan Datang
						</div>
						<hr/>
						
                        <div style="height: 500px; overflow: auto;">

                            @forelse($yangAkanDatang as $yangAkanDatang)
                            <div class="wrap-kelas form-inline mt-3">
                                <div>
                                    <span class="kelas-title disable">
                                        Kelas {{ @$yangAkanDatang->tingkat->name ?? '-' }} {{ @$sedangDipelajari->tingkat->jenjang->name }}
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
			
		</div>
	</div>
</section>
@endsection