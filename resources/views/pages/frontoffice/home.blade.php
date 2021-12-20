@extends('layouts.frontoffice')

@section('title', __("Home"))

@section('content')
<!-- Slider Start -->
    <section class="slider">
        <div class="">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="block">
                        <!-- <span class="d-block mb-3 text-white text-capitalize">Lorem ipsum dolor sit amet</span>
                        <h1 class="animated fadeInUp mb-5">Our work is <br>presentation of our <br>capabilities.</h1> -->

                        <div id="top-banner" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#top-banner" data-slide-to="0" class="active"></li>
                            <li data-target="#top-banner" data-slide-to="1"></li>
                            <li data-target="#top-banner" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="https://via.placeholder.com/1000x250?text=Slide+1+1000x250" class="d-block w-100" alt="Slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5 class="text-white">Lorem ipsum dolor sit amet</h5>
                                    <p class="text-white">Lorem ipsum dolor sit amet</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="https://via.placeholder.com/1000x250?text=Slide+2+1000x250" class="d-block w-100" alt="Slide">
                            </div>
                            <div class="carousel-item">
                                <img src="https://via.placeholder.com/1000x250?text=Slide+3+1000x250" class="d-block w-100" alt="Slide">
                            </div>
                        </div>
                        <!-- <a class="carousel-control-prev" href="#top-banner" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#top-banner" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section Intro Start -->

    <section class="mt-5">
        <div class="container">
            <div class="row mb-2">
                <!-- Buat siswa -->
                @if(!@\Auth::user()->is_pengunjung)
                <div class="col-md-12 mb-1">
                    <div class="card-title mb-0 form-inline">
                        <i class="ni ni-books icon-title"></i>
                        <div class="font-weight-bolder" style="color: #0E594D;">Mata Pelajaran yang Sedang Dipelajari</div>
                    </div>
                    <hr/>
                </div>

                <!-- sedang dipelajari -->
                @forelse($sedangDipelajari as $sedangDipelajari)
                <div class="col-md-2 col-sm-4 mb-4">
                    <a href="{{ route('app.mapel.detail', @$sedangDipelajari->id) }}">
                        <img src="{{ @$sedangDipelajari->icon ? asset($sedangDipelajari->icon) : asset('images/image-placeholder.jpg') }}" alt="{{ @$sedangDipelajari->name ?? "-" }}" width="100%" class="mb-3 rounded" />

                        <p class="font-weight-bold mb-0" style="font-size: 16px; line-height: 10px;">
                            {{ @$sedangDipelajari->name ?? "-" }}
                        </p>
                    </a>
                    <span style="font-size: 14px;">
                        {{ $sedangDipelajari->tingkat->name ?? "-" }} {{ @$sedangDipelajari->tingkat->jenjang->name }}
                    </span>
                </div>
                @empty
                <div class="col-md-12 mb-4">
                    <div class="wrap-kelas form-inline mt-3">
                        <h4 class="font-weight-bold">Belum ada mata pelajaran.</h4>
                    </div>
                </div>
                @endforelse
                <!-- end sedang dipelajari -->

                <!-- akan datang -->
                <!-- <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title mb-0 form-inline">
                                <i class="ni ni-books icon-title"></i>
                                <div>Mata Pelajaran yang Akan Datang</div>
                            </div>
                            <hr/>

                            @forelse($yangAkanDatang as $yangAkanDatang)
                            <div class="wrap-kelas-disable form-inline mt-3">
                                <div style="max-width: 270px;">
                                    <span class="kelas-title">Kelas {{ @$yangAkanDatang->tingkat->name ?? '-' }} {{ @$yangAkanDatang->tingkat->jenjang->name }}</span>
                                    <h4 class="font-weight-bold disable">
                                        {{ @$yangAkanDatang->name ?? "-" }}
                                    </h4>
                                </div>
                            </div>
                            @empty
                            <div class="wrap-kelas-disable form-inline mt-3">
                                <div>
                                    <h4 class="font-weight-bold disable">
                                        Belum ada mata pelajaran.
                                    </h4>
                                </div>
                            </div>
                            @endforelse

                            @if(!empty($yangAkanDatang))
                            <div class="mt-2 text-right">
                                <a href="{{ route('app.mapel.upcoming') }}">Selengkapnya</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div> -->
                <!-- End Buat siswa -->
                @else
                <!-- mapel aktif -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title mb-0 form-inline">
                                <i class="ni ni-books icon-title"></i>
                                <div>Mata Pelajaran Aktif</div>
                            </div>
                            <hr/>

                            @forelse($aktif as $mpa)
                            <div class="wrap-kelas form-inline mt-3">
                                <div style="max-width: 270px;">
                                    <span class="kelas-title">Kelas {{ $mpa->tingkat->name ?? "-" }} {{ @$mpa->tingkat->jenjang->name }}</span>
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

                            @if(!empty($mpa))
                            <div class="mt-2 text-right">
                                <a href="{{ route('app.mapel.list') }}">Selengkapnya</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- mapel tidak aktif -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title mb-0 form-inline">
                                <i class="ni ni-books icon-title"></i>
                                <div>Mata Pelajaran Tidak Aktif</div>
                            </div>
                            <hr/>

                            @forelse($tidakAktif as $mpta)
                            <div class="wrap-kelas form-inline mt-3">
                                <div style="max-width: 270px;">
                                    <span class="kelas-title disable">Kelas {{ $mpta->tingkat->name ?? "-" }} {{ @$mpta->tingkat->jenjang->name }}</span>
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

                            @if(!empty($mpta))
                            <div class="mt-2 text-right">
                                <a href="{{ route('app.mapel.list') }}">Selengkapnya</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- khusus siswa -->
            @if(!@\Auth::user()->is_pengunjung)
            <!-- Update terbaru -->
            <div class="row my-5">
                <div class="col-md-2 my-auto">
                    <h4 class="font-weight-bolder" style="color: #0E594D;">Update Terbaru</h4>
                </div>

                <div class="col-md-10">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators indicator-custom">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="card">
                                    <div class="card-body">
                                        Lorem ipsum dolor sit amet
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="card">
                                    <div class="card-body">
                                        Lorem ipsum dolor sit amet 2
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End update terbaru -->

            <!-- Semua Mata Pelajaran -->
            <div class="row">
                <!-- <div class="col-md-12 mb-1">
                    <div class="card-title mb-0 form-inline">
                        <i class="ni ni-books icon-title"></i>
                        <div class="font-weight-bolder" style="color: #0E594D;">Semua Mata Pelajaran</div>
                    </div>
                    <hr/>
                </div>
                
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-body mx-auto my-auto">
                            <span class="font-weight-500">
                                Kelas 1
                            </span>
                        </div>
                    </div>
                </div> -->
                
            </div>
            <!-- End Semua Mata Pelajaran -->
            @endif
        </div>
</section>
@endsection

@push('style')
<style>
    .indicator-custom li {
        background-color: #000;
    }
</style>
@endpush

@push('script')
<script type="text/javascript">
    $(function() {
        $(".carousel-items").each(function() {
            var i = $(this).next();
            console.log("dika i", i)
            i.length || (i = $(this).siblings(":first")),
                i.children(":first-child").clone().appendTo($(this));
            
            for (var n = 0; n < 4; n++)(i = i.next()).length ||
                (i = $(this).siblings(":first")),
                i.children(":first-child").clone().appendTo($(this))
        })
    });
</script>
@endpush