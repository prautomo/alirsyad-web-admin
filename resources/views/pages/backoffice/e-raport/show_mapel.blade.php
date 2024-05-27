@extends('layouts.backoffice')

@section('title', __("Raport ADL"))

@section('header')
  @parent
  <style>
    .row-student-info{
      padding: 0.8rem 1.5rem;
      background: #023402;
      color: white;
      border-radius: 5px;
      text-align: center;
      font-weight: 700;
    }
    .row-bab{
        background: #E98A15;
        color: white;
        font-weight: 700;
    }
    .row-mapel{
        background: #3C5BFF;
        color: white;
        font-weight: 700;
    }
    .row-filter{
        justify-content: flex-end; 
        text-align: right;
        align-items: center;
    }
    option{
        text-align: left;
    }
  </style>
@endsection

@section('content')
<div class="row">
    <div class="col">
        @if (session('status') === 'success')
            <x-alert.success :message="session('message')" />
        @elseif (session('status') === 'failed')
            <x-alert.failed :message="session('message')" />
        @endif
    <div class="card bg-transparent">
      <!-- tble -->
      <div class="">
        
        <div class="row row-student-info">
          <div class="col-3">
            Zahra Mubarok
          </div>
          <div class="col-2">
            SD
          </div>
          <div class="col-2">
            4
          </div>
          <div class="col-2">
            B
          </div>
          <div class="col-3">
            2019
          </div>
        </div>

        <div class="row mt-3">
            <div class="col-6">

            </div>
            <div class="col-6">
                <div class="row row-filter">
                    <div class="col-3">
                        <p class="mb-0">Filter by</p>
                    </div>
                    <div class="col-3">
                        <select id="select-mapel" class="btn btn-green-pastel dropdown-toggle w-100">
                            @foreach ($mapelList as $mapel)
                                <option value="{{ $mapel->id }}" {{ $selectedMapel == $mapel->id ? 'selected' : ''}}>{{ $mapel->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <select id="select-bab" class="btn btn-green-pastel dropdown-toggle w-100">
                            <option value="">Bab</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <select id="select-subbab" class="btn btn-green-pastel dropdown-toggle w-100">
                            <option value="">Subbab</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
       
        <!-- tble -->
        <div class="table table-responsive">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                <tr>
                    <th scope="col">BAB Pelajaran</th>
                    <th scope="col">Easy</th>
                    <th scope="col">Medium</th>
                    <th scope="col">Hard</th>
                    <th scope="col">Final Score</th>
                    {{-- {{ dd($data['name'])}} --}}
                </tr>
                </thead>
                <tbody class="list">
                    @foreach($data['babs'] as $bab)
                        @foreach($bab['subbabs'] as $subbab)
                            <tr>
                                <td>{{ $subbab['name'] }}</td>
                                <td>{{ $subbab['mudah'] }}</td>
                                <td>{{ $subbab['sedang'] }}</td>
                                <td>{{ $subbab['sulit'] }}</td>
                                <td>{{ $subbab['total'] }}</td>
                            </tr>
                        @endforeach
                        <tr class="row-bab">
                            <td>{{ $bab['name'] }}</td>
                            <td>{{ $bab['mudah'] }}</td>
                            <td>{{ $bab['sedang'] }}</td>
                            <td>{{ $bab['sulit'] }}</td>
                            <td>{{ $bab['total'] }}</td>
                        </tr>
                    @endforeach
                    <tr class="row-mapel">
                        <td>{{ $data['name'] }}</td>
                        <td>{{ $data['mudah'] }}</td>
                        <td>{{ $data['sedang'] }}</td>
                        <td>{{ $data['sulit'] }}</td>
                        <td>{{ $data['total'] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
      </div>
      <!-- endtble -->
    </div>
  </div>
</div>

@endsection
