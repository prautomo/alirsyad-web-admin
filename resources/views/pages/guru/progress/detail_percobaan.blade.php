@extends('layouts.guru')

@section('title', 'Detail Percobaan')

@section('header')
  @parent
  <div class="row align-items-center py-4">
    <div class="col-lg-6 col-7">
      <h6 class="h2 text-dark d-inline-block mb-0">@yield('title')</h6>
    </div>
  </div>
@endsection

@section('content')
<!-- detail progress -->
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h3 class="mb-0 font-weight-300">
                    Progres Siswa - {{ @$siswa->name }}
                </h3>
                <h4 class="mb-0 font-weight-bolder">
                    Detail Progres ({{ @$simulasi->name }}) - Level {{ @$simulasi->level ?? 1 }}
                </h4>
                <h5>{{ @$simulasi->mataPelajaran->name }}</h5>
            </div>
            <div class="card-body" style="max-height: 500px;overflow-y: auto;" class="pb-1">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th width="65%">Percobaan</th>
                            <th width="30%" class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no=1;
                        @endphp
                        @forelse((@$simulasi->scores ?? []) as $scorePercobaan)
                        <tr>
                            <td class="text-center">
                                {{ $no }}
                            </td>
                            <td>
                                Percobaan {{ @$scorePercobaan->percobaan_ke ?? 0 }}
                            </td>
                            <td class="text-center">
                                {{ ((@$scorePercobaan->score ?? 0) == 100) ? "Berhasil" : "Gagal" }}
                            </td>
                        </tr>
                        @php
                            $no++;
                        @endphp
                        @empty
                        <tr>
                            <td class="" colspan="3">
                                Belum ada percobaan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h4 class="mb-0 font-weight-bolder">
                    Progres {{ @$simulasi->name }} - Level {{ @$simulasi->level ?? 1 }}
                </h4>
                <h5>{{ @$simulasi->mataPelajaran->name }}</h5>
            </div>
            <div class="card-body">
                <div id="detail-simulasi-percobaan"
                    simulasi-id="{{ @$simulasi->id }}"
                    siswa-id="{{ @$siswa->id }}"        
                >Loading...</div>
            </div>
        </div>

        <div class="text-center">
            @if($simulasi->previous_level)
            <a href="{{ route('guru::simulasi.percobaan-siswa', @$simulasi->previous_level['id'] ?? 0) }}?q_siswa_id={{ \Request::get('q_siswa_id') }}">
                <img src="{{ asset('images/arrow-left.png') }}" height="40px" />
            </a>
            @elseif($simulasi->previous)
            <a href="{{ route('guru::simulasi.percobaan-siswa', @$simulasi->previous['id'] ?? 0) }}?q_siswa_id={{ \Request::get('q_siswa_id') }}">
                <img src="{{ asset('images/arrow-left.png') }}" height="40px" />
            </a>
            @endif

            @if($simulasi->next_level)
            <a href="{{ route('guru::simulasi.percobaan-siswa', @$simulasi->next_level['id'] ?? 0) }}?q_siswa_id={{ \Request::get('q_siswa_id') }}">
                <img src="{{ asset('images/arrow-right.png') }}" height="40px" />
            </a>
            @elseif($simulasi->next)
            <a href="{{ route('guru::simulasi.percobaan-siswa', @$simulasi->next['id'] ?? 0) }}?q_siswa_id={{ \Request::get('q_siswa_id') }}">
                <img src="{{ asset('images/arrow-right.png') }}" height="40px" />
            </a>
            @endif
        </div>
    </div>
</div>
@endsection