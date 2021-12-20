@extends('layouts.frontoffice')

@section('title', __("Home"))

@section('content')
<!-- Slider Start -->
<section class="slider">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-10">
                    <div class="block">
                        <span class="d-block mb-3 text-white text-capitalize">Lorem ipsum dolor sit amet</span>
                        <h1 class="animated fadeInUp mb-5">Our work is <br>presentation of our <br>capabilities.</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section Intro Start -->

    <section class="mt-5">
        <div class="container">
            <div class="row">
                <!-- Buat siswa -->
                @if(!@\Auth::user()->is_pengunjung)
                <div class="col-md-12 mb-1">
                    <div class="card-title mb-0 form-inline">
                        <i class="ni ni-books icon-title"></i>
                        <div>Mata Pelajaran yang Sedang Dipelajari</div>
                    </div>
                    <hr/>
                </div>

                <!-- sedang dipelajari -->
                @forelse($sedangDipelajari as $sedangDipelajari)
                <div class="col-md-2 mb-4">
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
        </div>
</section>
@endsection
