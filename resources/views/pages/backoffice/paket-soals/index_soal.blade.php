@extends('layouts.backoffice')

@section('title', __("Paket Soal"))

@section('header')
  @parent
    <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
            <h6 class="h2 text-dark d-inline-block mb-0">@yield('title')</h6>
        </div>
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col col-md-6">
                        <table class="w-100">
                            <tr>
                                <td style="width: 150px">Mata Pelajaran</td>
                                <td style="width: 20px">:</td>
                                <td>{{ @$paket_soal->mataPelajaran->name }}</td>
                            </tr>
                            <tr>
                                <td>Bab</td>
                                <td>:</td>
                                <td>{{ @$paket_soal->bab->name }}</td>
                            </tr>
                            <tr>
                                <td>Subbab</td>
                                <td>:</td>
                                <td>SUBBAB {{ @$paket_soal->subbab }} {{ @$paket_soal->judul_subbab }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col col-md-6">
                        <table class="w-100">
                            <tr>
                                <td style="width: 150px">Tingkat Kesulitan</td>
                                <td style="width: 20px">:</td>
                                <td>{{ @$paket_soal->tingkat_kesulitan }}</td>
                            </tr>
                            <tr>
                                <td>Jumlah Publish</td>
                                <td>:</td>
                                <td>{{ @$paket_soal->jumlah_publish }}</td>
                            </tr>
                            <tr>
                                <td>Nilai KKM</td>
                                <td>:</td>
                                <td>{{ @$paket_soal->nilai_kkm }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col col-md-12">
                        <a href="{{ route('backoffice::paket-soals.edit', $id) }}" type="button" class="btn btn-primary btn-sm">Edit</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
                
                <div class="form-inline mb-0">
                    <h3 class="my-auto">Bank Soal</h3>
                    <div class="ml-auto">
                        <a href="{{ route('backoffice::paket-soals.create-soal', $id) }}" class="btn btn-sm btn-neutral">New</a>
                        <a href="{{ route('backoffice::paket-soals.batch-soal', $id) }}" class="btn btn-sm btn-primary">Import From Excel</a>
                    </div>
                </div>
            </div>
            <!-- tble -->
            <div class="">
                <x-datatable>
                    {{--
                        data-* is same as option columns in datatable
                        https://datatables.net/reference/option/columns
                    --}}
                    <th data-data="DT_RowIndex" data-searchable="false">@lang("No")</th>
                    <!-- <th data-data="show-img">@lang("Cover")</th> -->
                    <th data-data="soal">@lang("Soal")</th>
                    <th data-data="pilihan_a">@lang("Pilihan a")</th>
                    <th data-data="pilihan_b">@lang("Pilihan b")</th>
                    <th data-data="pilihan_c">@lang("Pilihan c")</th>
                    <th data-data="pilihan_d">@lang("Pilihan d")</th>
                    <th data-data="pilihan_e">@lang("Pilihan e")</th>
                    <th data-data="jawaban">@lang("Jawaban")</th>
                    <!-- <th data-data="created_at">@lang("Created At")</th> -->
                    <th data-data="action" data-orderable="false" data-searchable="false">@lang("Action")</th>
                </x-datatable>
            </div>
        <!-- endtble -->
        </div>
    </div>
</div>

@endsection