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

    <section class="section">
        <div class="container">
            <div class="row">
                <!-- sedang dipelajari -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title mb-0 form-inline">
                                <i class="ni ni-books icon-title"></i>
                                <div>Mata Pelajaran yang Sedang Dipelajari</div>
                            </div>
                            <hr/>

                            @forelse($sedangDipelajari as $sedangDipelajari)
                            <div class="wrap-kelas form-inline mt-3">
                                <div style="max-width: 270px;">
                                    <span class="kelas-title">Kelas {{ $sedangDipelajari->tingkat->name ?? "-" }} {{ @$sedangDipelajari->tingkat->jenjang->name }}</span>
                                    <h4 class="font-weight-bold">
                                        {{ @$sedangDipelajari->name ?? "-" }}
                                    </h4>
                                </div>
                                <div class="ml-auto">
                                    <a href="{{ route('app.mapel.detail', @$sedangDipelajari->id) }}" class="btn btn-main btn-small">
                                        <i class="btn-icon fa fa-play ml-2"></i> Lanjut Belajar
                                    </a>
                                </div>
                            </div>
                            @empty
                            <div class="wrap-kelas form-inline mt-3">
                                <h4 class="font-weight-bold">Belum ada mata pelajaran.</h4>
                            </div>
                            @endforelse

                            @if(!empty($sedangDipelajari))
                            <div class="mt-2 text-right">
                                <a href="{{ route('app.mapel.list') }}">Selengkapnya</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- akan datang -->
                <div class="col-md-6">
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
                </div>
            </div>
        </div>
</section>
@endsection
