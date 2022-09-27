@extends('layouts.frontoffice')

@section('title', __("Home"))

@section('content')
<!-- Slider Start -->
    @if(count($banners) > 0)
    <!-- <section class="slider"> -->
    <section class="">
        <div class="">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="block">
                        <!-- <span class="d-block mb-3 text-white text-capitalize">Lorem ipsum dolor sit amet</span>
                        <h1 class="animated fadeInUp mb-5">Our work is <br>presentation of our <br>capabilities.</h1> -->

                        <div id="top-banner" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @foreach($banners as $idx => $banner)
                            <li data-target="#top-banner" data-slide-to="{{ $idx }}" class="{{ $idx == 0 ? ' active': '' }}"></li>
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                            @foreach($banners as $idx => $banner)
                            <div class="carousel-item{{ $idx == 0 ? ' active': '' }}">
                                <div style="cursor: pointer;" data-toggle="modal" data-target="#exampleModal" data-file="{{ asset(@$banner->file) }}">
                                    <img src="{{ asset(@$banner->image) }}" class="d-block w-100" alt="{{ @$banner->title }}">
                                </div>
                                <!-- <div class="carousel-caption d-none d-md-block">
                                    <h5 class="text-white">Lorem ipsum dolor sit amet</h5>
                                    <p class="text-white">Lorem ipsum dolor sit amet</p>
                                </div> -->
                            </div>
                            @endforeach
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
    @endif
    <!-- Section Intro Start -->

    <section class="mt-5">
        <div class="container">
            <div class="row mb-2">
                <!-- Buat siswa -->
                @if(!@\Auth::user()->is_pengunjung)
                <div class="col-md-12 mb-1">
                    <div class="card-title mb-0 form-inline">
                        <!-- <i class="ni ni-books icon-title"></i> -->
                        <div class="font-weight-bolder" style="color: #0E594D;">Mata Pelajaran yang Sedang Dipelajari</div>
                    </div>
                    <hr/>
                </div>

                <!-- sedang dipelajari -->
                @forelse($sedangDipelajari as $sedangDipelajari)
                <div class="col-md-2 col-6 col-sm-4 mb-4">
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
                <div class="col-md-12 mb-1">
                    <div class="card-title mb-0 form-inline">
                        <!-- <i class="ni ni-books icon-title"></i> -->
                        @if(@\Auth::user()->status !== "AKTIF")
                        <div class="font-weight-bolder" style="color: #0E594D;">Mata Pelajaran</div>
                        @else
                        <div class="font-weight-bolder" style="color: #0E594D;">Mata Pelajaran Aktif</div>
                        @endif
                    </div>
                    <hr/>
                </div>

                    @forelse($aktif as $mpa)
                    <div class="col-md-2 col-6 col-sm-4 mb-4">
                        {{-- even user are not yet confirmed, matpel button is always clickable (beda di kontennya) --}}
                        <a href="{{ route('app.mapel.detail', @$mpa->id) }}">
                            <img src="{{ @$mpa->icon ? asset($mpa->icon) : asset('images/image-placeholder.jpg') }}" alt="{{ @$mpa->name ?? "-" }}" width="100%" class="mb-3 rounded" />

                            <p class="font-weight-bold mb-0" style="font-size: 16px; line-height: 14px;">
                                {{ @$mpa->name ?? "-" }}
                            </p>
                        </a>
                        <span style="font-size: 14px;">
                            {{ @$mpa->tingkat->name ?? "-" }} {{ @$mpa->tingkat->jenjang->name }}
                        </span>
                    </div>
                    @empty
                    <div class="col-md-12 mb-4">
                        <div class="wrap-kelas form-inline mt-3">
                            <h4 class="font-weight-bold">Belum ada mata pelajaran.</h4>
                        </div>
                    </div>
                    @endforelse
                @endif
            </div>

            <!-- Update terbaru -->
            <div class="row my-5">
                <div class="col-md-12 mb-1">
                    <div class="card-title mb-0 form-inline">
                        <!-- <i class="ni ni-books icon-title"></i> -->
                        <div class="font-weight-bolder" style="color: #0E594D;">Update Terbaru</div>

                        <!-- <div class="font-weight-300 ml-auto">
                            <a href="{{ route('app.update') }}" style="color: #0E594D !important;">Selengkapnya...</a>
                        </div> -->
                    </div>
                    <hr/>
                </div>

                
                @forelse($updates as $update)
                <div class="col-md-2 col-6 col-sm-4">
                    @if(@\Auth::user()->status !== "AKTIF")
                    <img src="{{ asset((@$update->logo === '' || @$update->logo === null) ? 'images/image-placeholder.jpg' : $update->logo) }}" alt="{{ @$update->trigger_name ?? "-" }}" title="{{ @$update->trigger_name ?? "-" }}" width="100%" class="mb-3 rounded" />
                    @else
                    <a href="{{ route('app.'.(@$update->trigger ?? 'video').'.detail', @$update->trigger_id) }}">
                        <img src="{{ asset((@$update->logo === '' || @$update->logo === null) ? 'images/image-placeholder.jpg' : $update->logo) }}" alt="{{ @$update->trigger_name ?? "-" }}" title="{{ @$update->trigger_name ?? "-" }}" width="100%" class="mb-3 rounded" />
                    </a>
                    @endif
                </div>
                @empty
                <div class="col-md-12 mb-4">
                    @if(@\Auth::user()->status !== "AKTIF")
                        <div class="wrap-kelas form-inline mt-3">
                            <h4 class="font-weight-bold">Update terbaru hanya untuk pengunjung khusus.</h4>
                        </div>
                    @else
                        <div class="wrap-kelas form-inline mt-3">
                            <h4 class="font-weight-bold">Belum ada mata update terbaru.</h4>
                        </div>
                    @endif
                    
                </div>
                @endforelse

                @if($countUpdates > 5)
                <div class="col-md-2 col-6 col-sm-4 my-auto">
                    <div class="font-weight-300 ">
                        <a href="{{ route('app.update') }}" style="color: #0E594D !important;">Selengkapnya...</a>
                    </div>
                </div>
                @endif

                <!-- <div class="col-md-4 my-auto text-center">
                    <h4 class="font-weight-bolder" style="color: #0E594D;">Update Terbaru</h4>
                </div> -->

                <!-- <div class="col-md-8">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators indicator-custom">
                            @forelse($updates as $idx => $update)
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $idx }}" class="{{ $idx == 0 ? ' active': '' }}"></li>
                            @empty
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            @endforelse
                        </ol>
                        <div class="carousel-inner">
                            @forelse($updates as $idx => $update)
                            <div class="carousel-item{{ $idx == 0 ? ' active': '' }}">
                                <div class="card">
                                    <div class="card-body mb-3">
                                        <img height="75px" width="75px" align="left" src="{{ asset((@$update->logo === '' || @$update->logo === null) ? 'images/image-placeholder.jpg' : $update->logo) }}" class="mr-2" />
                                        <a href="{{ route('app.'.(@$update->trigger ?? 'video').'.detail', @$update->trigger_id) }}">
                                            <i>{{@$update->trigger_name}}</i>
                                        </a> baru saja di-{{ @$update->trigger_event == 'create' ? 'upload' : 'update' }} di mata pelajaran
                                        <a href="{{ route('app.mapel.detail', @$update->{@$update->trigger ?? 'video'}->mata_pelajaran_id ?? 0) }}">
                                            <i>{{ @$update->mata_pelajaran }}</i>
                                        </a>.
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="carousel-item active">
                                <div class="card">
                                    <div class="card-body mb-3">
                                        Belum ada update terbaru.
                                    </div>
                                </div>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div> -->
            </div>
            <!-- End update terbaru -->

            <!-- Semua Mata Pelajaran -->
            @if(count($kelasList) > 0)
            <div class="row">
                <div class="col-md-12 mb-1">
                    <div class="card-title mb-0 form-inline">
                        <!-- <i class="ni ni-books icon-title"></i> -->
                        <div class="font-weight-bolder" style="color: #0E594D;">Semua Mata Pelajaran</div>
                    </div>
                    <hr/>
                </div>

                @foreach($kelasList as $kelas)
                <div class="col-md-2 mb-2 wrap-card-kelas">
                    <a href="{{ route('app.mapel.byTingkat', ['id' => @$kelas->id ?? 0]) }}">
                        <img src="{{ asset(@$kelas->logo!=='' ? $kelas->logo : 'images/image-placeholder.jpg') }}" width="100%" />
                        <!-- <div class="card card-kelas" style="background-image: url('{{ asset(@$kelas->logo!=='' ? $kelas->logo : 'images/image-placeholder.jpg') }}')">
                            <div class="pl-2 pt-1">
                                <span class="badge badge-warning" style="border-radius: 100%;">
                                    {{ @$kelas->jenjang->name ?? '-' }}
                                </span>
                            </div>
                            <div class="card-body mx-auto my-auto pt-1">
                                <span class="text-main font-weight-500" style="font-size: 14px;">
                                    Kelas {{ @$kelas->name ?? '-' }}
                                </span>
                            </div>
                        </div> -->
                    </a>
                </div>
                @endforeach

            </div>
            @endif
            <!-- End Semua Mata Pelajaran -->
        </div>
</section>
@endsection

@push('style')
<style>
    .indicator-custom li {
        background-color: #000;
    }

    .card-kelas {
        color: #0E594D;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        border-radius: 15px;
        font-weight: bolder;
    }

    @media (min-width: 992px) {
        /* .wrap-card-kelas {
            max-width: 150px !important;
        } */
    }
</style>
@endpush

@push('script')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Preview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="pdf-viewer-file"></div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-main btn-small" data-dismiss="modal">Close</button>
      </div> -->
    </div>
  </div>
</div>
<script type="text/javascript">
    // $(function() {
    //     $(".carousel-items").each(function() {
    //         var i = $(this).next();
    //         console.log("dika i", i)
    //         i.length || (i = $(this).siblings(":first")),
    //             i.children(":first-child").clone().appendTo($(this));

    //         for (var n = 0; n < 4; n++)(i = i.next()).length ||
    //             (i = $(this).siblings(":first")),
    //             i.children(":first-child").clone().appendTo($(this))
    //     })
    // });

    $('#exampleModal').on('show.bs.modal', function (event) {
        var container = $(event.relatedTarget)
        var fileUrl = container.data('file')
        var modal = $(this);
        let template = "<object type='application/pdf' width='100%' height='430px' data= '" + fileUrl + "'>";
        modal.find('#pdf-viewer-file').html(template)
    })
</script>
@endpush
