@extends('layouts.backoffice')

@section('title', __("Transaction Products"))

@section('header')
  @parent
    <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0">@yield('title')</h6>
        </div>
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
    <div class="card">
      <!-- Card header -->
      <div class="card-header border-0">
        <h3 class="mb-0">Data</h3>
      </div>
      <!-- tble -->
      <div class="table-responsive">
            <x-datatable>
                {{--
                    data-* is same as option columns in datatable
                    https://datatables.net/reference/option/columns
                --}}
                <th data-data="kode_transaksi">@lang("Transaction Code")</th>
                <th data-data="customer_name">@lang("Customer Name")</th>
                <th data-data="mitra_name">@lang("Mitra Name")</th>
                <th data-data="status_transaksi">@lang("Status Transaction")</th>
                <th data-data="total_transaksi">@lang("Total Transaction")</th>
                <th data-data="created_at">@lang("Created At")</th>
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
  function changeStatusTransaksi(id, route){
    Swal.fire({
        title: 'Select Status',
        input: 'select',
        inputOptions: {
            'BELUM_DIKONFIRMASI': 'Belum dikonfirmasi',
            'AKTIF': 'Aktif',
            'TIDAK_AKTIF': 'Tidak Aktif'
        },
        inputPlaceholder: 'Select a status',
        showCancelButton: true,
        inputValidator: (value) => {
            return new Promise((resolve) => {
                if (value === 'AKTIF' || value === 'TIDAK_AKTIF') {
                    var url = route
                    var payload = {
                        status: value
                    };
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: payload,
                    })
                    .done(function (response) {
                        Swal.fire(
                        'Updated!',
                        _.get(response, "message", '{{__("Status has been updated.")}}'),
                        'success'
                        ).then(() => {
                            $(".datatable-serverside").DataTable().destroy() 
                            const datatable = initDatatable('.datatable-serverside');
                            datatable.ajax.reload()
                        });
                    })
                    .fail(function (err) {
                        let message = '{{__("Status failed to update.")}}';

                        if (err.status === 404) {
                            message = '{{__("Data doesn\'t exists")}}';
                        } else {
                            message = _.get(err, "responseJSON.message", message);
                        }

                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: message
                        })
                    });

                    resolve()
                } else {
                    resolve('You need to select AKTIF or TIDAK_AKTIF :)')
                }
            })
        }
    })
}
</script>
@endpush