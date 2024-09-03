@extends('layouts.backoffice')

@section('title', \Request::get('role')=="GURU" ? __("Guru") : (\Request::get('is_pengunjung')==1 ? __("Pengunjung") : __("Siswa")))

@section('header')
  @parent
      <div class="d-flex align-items-center">
            <form class="form-inline mr-sm-3 search-main" id="search-main">
              <div class="form-group mb-0">
                <div class="input-group input-group-alternative input-group-merge search-bar-filter">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                  </div>
                  <input class="form-control" id="search-dt-table" placeholder="Cari NIS, Nama, Jenjang" type="text">
                </div>
              </div>
            </form>

            <div class="dropdown mr-3">
              <button class="btn btn-green-pastel dropdown-toggle" type="button" data-toggle="modal" data-target="#filterModal" aria-haspopup="true" aria-expanded="false">
                {{__("Filter")}}
              </button>
            </div>

            @can('external-user-create')
            <div style="margin-left: auto;">
              @if(\Request::get('role') === 'SISWA' && !@\Request::get('is_pengunjung'))
              <a href="{{ route('backoffice::external-users.next_grade', ['role'=>\Request::get('role')]) }}" class="btn btn-md btn-outline-primary">
                Naik Kelas
              </a>
              <a href="{{ route('backoffice::external-users.batch_create', ['role'=>\Request::get('role')]) }}" class="btn btn-md btn-outline-primary">
                Unggah XLSX
              </a>
              <a href="{{ route('backoffice::external-users.generateQRCodeBulk') }}" class="btn btn-md btn-secondary" id="btn-generate-qr">
                Generate QR Code
              </a>
              @endif

              @if(!@\Request::get('is_pengunjung'))
              <a href="{{ route('backoffice::external-users.create', ['role'=>\Request::get('role')]) }}" class="btn btn-md btn-primary">
                <i class="fa fa-plus text-light"></i>&nbsp;&nbsp;Tambah Data
              </a>
              @endif
            </div>
            @endcan
      </div>
    
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
          
            {{-- @php
              $col_to_filter = "";
              $is_multiple_col = "";
              if(\Request::get('role') == "GURU"){
                $col_to_filter = "3";
                $is_multiple_col = "1";
              }else if(\Request::get('role') == "SISWA" && \Request::get('is_pengunjung') == 0){
                $col_to_filter = "6,5,4,3";
                $is_multiple_col = "0,0,0,0";
              }else if(\Request::get('role') == "SISWA" && \Request::get('is_pengunjung') == 1){
                $col_to_filter = "3";
                $is_multiple_col = "0";
              }
            @endphp --}}
            <p></p>
            {{-- <x-datatable.table :filterCol="__($col_to_filter)" :isMultiple="__($is_multiple_col)" :customSearch="__(1)"> --}}
              <x-datatable.table :customSearch="__(1)">
                {{--
                    data-* is same as option columns in datatable
                    https://datatables.net/reference/option/columns
                --}}
                <th data-data="DT_RowIndex" data-searchable="false">@lang("No")</th>
                <!-- <th data-data="show-img">@lang("Image")</th> -->
                @if(\Request::get('role') === 'SISWA')
                <th data-data="nis">@lang("NIS")</th>
                @else
                <th data-data="nis">@lang("NIP")</th>
                @endif
                <th data-data="name">@lang("Name")</th>
                @if(\Request::get('role') === 'SISWA' && !@\Request::get('is_pengunjung'))
                <th data-data="kelas.tingkat.jenjang.name">@lang("Jenjang")</th>
                <th data-data="kelas.tingkat.name">@lang("Tingkat")</th>
                <th data-data="kelas.name">@lang("Kelas")</th>
                <th data-data="tahun_ajaran">@lang("Tahun Ajaran")</th>
                @elseif(\Request::get('role') === 'SISWA' && @\Request::get('is_pengunjung'))
                <th data-data="kelas.tingkat.jenjang.name">@lang("Jenjang")</th>
                @else
                <th data-data="mengajar">@lang("Mengajar")</th>
                @endif
                <th data-data="show-status">@lang("Status")</th>
                <th data-data="action" data-orderable="false" data-searchable="false">@lang("Action")</th>
            </x-datatable.table>
        </div>
      <!-- endtble -->
    </div>
  </div>
</div>

@endsection

@push('script')
<script>
   $(document).on('click', '#btn-generate-qr', function(event) {
        event.preventDefault();
        console.log('click before go')

        // TODO: need changes after redevelop table filter
        var selectedTahunId = 'select-tahun_ajaran' 
        var selectedTahun = $(`#${selectedTahunId}`).find(":selected").val();
        var selectedKelasId = 'select-kelas' 
        var selectedKelas = $(`#${selectedKelasId}`).find(":selected").val();
        var selectedTingkatId = 'select-tingkats' 
        var selectedTingkat = $(`#${selectedTingkatId}`).find(":selected").val();

        var linkGenerateQR = `external-users/generate-qr-code-bulk?tahun_ajaran=${selectedTahun}&kelas_id=${selectedKelas}&tingkat_id=${selectedTingkat}`
        $('#btn-generate-qr').attr("href", linkGenerateQR)
        
        location.href = linkGenerateQR;

    });

    $(document).ready(function(){
      
      var url_params = new URLSearchParams(window.location.search);
      var role = url_params.get('role');

      var filter_col = ""

      $.ajaxSetup({
        async: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:'GET',
            url:'/backoffice/external-users/filter-col?role=' + role,
            success:function(response){
                console.log('response', response)
                $('#btn-submit-filter').attr("href", window.location.pathname + response.params_origin);

                
                filter_col = response.data
                filter_col.forEach(filter => {
                          
                    var col_name = filter.name
                    var html_select = '<div id="filter-'+ col_name +'" class="form-group col">\
                        <label>'+ filter.label +'</label>\
                        <select id="select-'+ col_name +'"class="form-control"><option value="">All</option>'

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
            },
        });

        $('#btn-submit-filter').click(function() {
          var query_params = ""
          filter_col.forEach(filter => {
            var selected_val = $(`#select-${filter.name}`).find(":selected").val();

            if(selected_val != ""){
              if(query_params == ""){
                query_params = "?"
              }else{
                query_params += "&"
              }
              
              query_params += `${filter.param}=${selected_val}`
            }
          });
          $(this).attr("href", this.href + query_params);
        });
  });

</script>
@endpush