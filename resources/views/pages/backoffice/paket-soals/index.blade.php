@extends('layouts.backoffice')

@section('title', __("Latihan Soal"))

@section('header')
    @parent
    <div class="d-flex align-items-center">
        <form class="form-inline mr-sm-3 search-main" id="search-main">
            <div class="form-group mb-0">
                <div class="input-group input-group-alternative input-group-merge search-bar-filter">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                    <input class="form-control" id="search-dt-table" placeholder="Cari Judul, Mata Pelajaran, Tingkat" type="text">
                </div>
            </div>
        </form>

        <div class="dropdown mr-3">
            <button class="btn btn-green-pastel dropdown-toggle" type="button" data-toggle="modal" data-target="#filterModal" aria-haspopup="true" aria-expanded="false">
            {{__("Filter")}}
            </button>
        </div>

        @can('paket-soal-create')
        <div style="margin-left: auto;">
            <a href="{{ route('backoffice::paket-soals.create') }}" class="btn btn-md btn-primary">
                <i class="fa fa-plus text-light"></i>&nbsp;&nbsp;Tambah Data
            </a>
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
            <x-datatable.table :customSearch="__(1)">
                {{--
                    data-* is same as option columns in datatable
                    https://datatables.net/reference/option/columns
                --}}
                <th data-data="DT_RowIndex" data-searchable="false">@lang("No")</th>
                <!-- <th data-data="show-img">@lang("Cover")</th> -->
                <th data-data="subbab">@lang("Subbab")</th>
                <th data-data="judul_subbab">@lang("Judul Subbab")</th>
                <th data-data="mapel">@lang("Mata Pelajaran")</th>
                <th data-data="tingkat">@lang("Tingkat")</th>
                <th data-data="tingkat_kesulitan">@lang("Tingkat Kesulitan")</th>
                <th data-data="jumlah_soal">@lang("Jumlah Soal")</th>
                <th data-data="jumlah_publish">@lang("Jumlah Publish")</th>
                <th data-data="visibilitas">@lang("Visibilitas")</th>
                <!-- <th data-data="created_at">@lang("Created At")</th> -->
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
        var filter_col = ""

        $.ajaxSetup({
        async: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:'GET',
            url:'/backoffice/paket-soals/filter-col',
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
