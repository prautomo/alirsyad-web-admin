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
            {{ $user->name }}
          </div>
          <div class="col-2">
            {{ $user->kelas->tingkat->jenjang->name }}
          </div>
          <div class="col-2">
            {{ $user->kelas->tingkat->name }}
          </div>
          <div class="col-2">
            {{ $user->kelas->name }}
          </div>
          <div class="col-3">
            2019
          </div>
        </div>

        <div class="row mt-3">
            <div class="col-6">
                {{-- <div class="row">
                    <div class="col-2">
                        <p class="mb-0">View</p>
                    </div>
                    <div class="col-10">
                        <button class="btn btn-primary">Table</button>
                        <button class="btn btn-primary">Grafik</button>
                    </div>
                </div> --}}
            </div>
            <div class="col-6">
                <div class="row row-filter">
                    <div class="col-3">
                        <p class="mb-0">Filter by</p>
                    </div>
                    <div class="col-9">
                        <div id="filter-col" class="row">
                        </div>
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

@push('script')
<script>
    $(document).ready(function(){
      
        var url_params = new URLSearchParams(window.location.search);
        var current_url = window.location.pathname
        var selected_mapel = "<?php echo $selectedMapel; ?>";
        console.log('current_url', current_url)

        var filter_col = ""

        $.ajaxSetup({
        async: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:'GET',
            url: current_url +'/filter-col',
            success:function(response){
                console.log('response', response)
                // $('#btn-submit-filter').attr("href", window.location.pathname + response.params_origin);

                
                filter_col = response.data
                filter_col.forEach(filter => {
                        
                    var col_name = filter.name
                    var html_select = '<div class="col">\
                        <select id="select-'+ col_name +'"class="btn btn-green-pastel dropdown-toggle w-100 filter-dropdown"><option value="">'+ filter.label +'</option>'

                    // var url_params = new URLSearchParams(window.location.search);
                    var selected_val = url_params.get(filter.param);

                    var data = filter.data
                    data.forEach(element => {
                    html_select += '<option value="'+ element.val +'" '+ (selected_val == element.val ? 'selected' : '') +'>'+element.name+'</option>'
                    });

                    html_select += '</select>\
                        </div>'

                    $('#filter-col').append(html_select);
                });

                $('#select-mapel').val(selected_mapel);
            },
        });

        $(".filter-dropdown").change(function () {
            console.log('this.value', this.value)
            var changed_filter = this.id.split('-')[1];

            if(changed_filter == 'mapel'){
                var pathname_user = current_url.split('/');
                window.location.href = window.location.origin + '/' + pathname_user[1] + '/' + pathname_user[2] + '/' + pathname_user[3] + '/' + this.value
            }else{
                var query_params = ""
                filter_col.forEach(filter => {
                    if(filter.name == 'mapel')
                        return;

                    var selected_val = $(`#select-${filter.name}`).find(":selected").val();

                    if(selected_val != "")
                    query_params += `&${filter.param}=${selected_val}`
                });

                window.location.href = current_url + '?filter=true' + query_params
            }

        });
    });
</script>
@endpush

