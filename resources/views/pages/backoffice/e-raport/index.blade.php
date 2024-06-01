@extends('layouts.backoffice')

@section('title', __("Raport ADL"))

@section('header')
  @parent
  <style>
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
      <div class="row mt-3">
          <div class="col-4">
              <div class="row">
                  <div class="col-12">
                    <form class="form-inline mr-sm-3 search-main" id="search-main">
                      <div class="form-group mb-0">
                        <div class="input-group input-group-alternative input-group-merge search-bar-filter">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                          </div>
                          <input class="form-control" id="search-dt-table" placeholder="Cari nama atau NIS siswa" type="text">
                        </div>
                      </div>
                    </form>
                  </div>
              </div>
          </div>
          <div class="col-8">
              <div class="row row-filter">
                  <div class="col-12">
                      <div id="filter-col" class="row">
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- tble -->
      <div class="">
            <x-datatable.table :customSearch="__(1)">
                {{--
                    data-* is same as option columns in datatable
                    https://datatables.net/reference/option/columns
                --}}
                <th data-data="DT_RowIndex" data-searchable="false">@lang("No")</th>
                <!-- <th data-data="show-img">@lang("Cover")</th> -->
                <th data-data="nis">@lang("NIS")</th>
                <th data-data="name">@lang("Nama")</th>
                <th data-data="jenjang">@lang("Jenjang")</th>
                <th data-data="tingkat">@lang("Tingkat")</th>
                <th data-data="kelas">@lang("Kelas")</th>
                <th data-data="tahun_ajaran">@lang("Tahun Ajaran")</th>
                <th data-data="action" data-orderable="false" data-searchable="false">@lang("Action")</th>
            </x-datatable>
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

      var filter_col = ""

      $.ajaxSetup({
        async: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:'GET',
            url:'/backoffice/json/e-raport/filter-col',
            success:function(response){
                console.log('response', response)
                $('#btn-submit-filter').attr("href", window.location.pathname + response.params_origin);

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

            },
        });

        $(".filter-dropdown").change(function () {
            var query_params = ""
            filter_col.forEach(filter => {
                var selected_val = $(`#select-${filter.name}`).find(":selected").val();

                if(selected_val != "")
                query_params += `&${filter.param}=${selected_val}`
            });

            window.location.href = current_url + '?filter=true' + query_params
        });
  });
</script>
@endpush
