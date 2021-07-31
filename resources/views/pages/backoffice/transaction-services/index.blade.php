@extends('layouts.backoffice')

@section('title', __("Transaction Services"))

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
                <th data-data="jasa_name">@lang("Service Vendor")</th>
                <th data-data="jasa_sub_category">@lang("Service Sub Category")</th>
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
$(document).ready(function () {
  // cancel
  $(document).on('click', '.cancel-btn', function(event) {
    event.preventDefault();
    const url = $(this).attr("href");
    const name = $(this).data("name");
    const text = "{{__("Are you sure you want to cancel :name?")}}";

    if (url) {
      Swal.fire({
          title: "Confirmation",
          text: text.replace(":name", name || "{{__("this transaction")}}"),
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#d33",
          cancelButtonColor: "#3085d6",
          confirmButtonText: "{{__("Yes")}}"
      })
      .then(result => {
          if (result.value) {
              var payload = {
                status_transaksi: "DIBATALKAN"
              };
              $.ajax({
                url: url,
                type: "POST",
                data: payload,
              })
              .done(function (response) {
                  Swal.fire(
                  'Canceled!',
                  _.get(response, "message", '{{__("Your transaction has been cancel.")}}'),
                  'success'
                  ).then(() => {
                    $(".datatable-serverside").DataTable().destroy() 
                    const datatable = initDatatable('.datatable-serverside');
                    datatable.ajax.reload()
                  });
              })
              .fail(function (err) {
                  let message = '{{__("Your data failed to delete.")}}';

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
          }
      });
    }
  });
  // end cancel

  // survei
  $(document).on('click', '.survei-btn', function(event) {
    event.preventDefault();
    const url = $(this).attr("href");
    var payload = {
      status_transaksi: "SURVEI"
    };
    $.ajax({
      url: url,
      type: "POST",
      data: payload,
    })
    .done(function (response) {
        Swal.fire(
        'Success!',
        _.get(response, "message", '{{__("Your transaction status has been changed to survey.")}}'),
        'success'
        ).then(() => {
          $(".datatable-serverside").DataTable().destroy() 
          const datatable = initDatatable('.datatable-serverside');
          datatable.ajax.reload()
        });
    })
    .fail(function (err) {
        let message = '{{__("Your data failed to change status.")}}';

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
  });
  // end survei

  // assign mitra
  $(document).on('click', '.assign-mitra-btn', async function(event) {
    event.preventDefault();
    const url = $(this).attr("href");
    const sub_service_id = $(this).data("sub_service_id");
    
    const options = [];
    await $.ajax({ 
      type: 'GET', 
      url: '{{URL::to("/")}}/sub-services/'+sub_service_id+'/mitra', 
      dataType: 'json',
      success: function (data) { 
        $.each(data.data, function(index, element) {
          options.push("<option value='"+element.jasa_id+"'>"+element.user.name+"</option>");
        });
      }
    });
    
    const { value: formValues } = await Swal.fire({
      title: 'Assign Mitra Service',
      html:
        'Harga Perhari : <input id="harga_perhari" class="swal2-input">' +
        'Jumlah Hari : <input id="jumlah_hari" class="swal2-input">'+
        'Mitra : <select id="jasa_id" class="swal2-input">'+
        options.join("")+
        '</select>',
      focusConfirm: false,
      preConfirm: () => {
        return [
          document.getElementById('harga_perhari').value,
          document.getElementById('jumlah_hari').value,
          document.getElementById('jasa_id').value
        ]
      }
    })

    if (formValues) {
      const harga_perhari = formValues[0]
      const jumlah_hari = formValues[1]
      const jasa_id = formValues[2]
      
      var payload = {
        status_transaksi: "VENDOR_NEGO",
        jasa_id: jasa_id,
        jumlah_hari: parseInt(jumlah_hari),
        harga_perhari: parseInt(harga_perhari),
      };
      $.ajax({
        url: url,
        type: "POST",
        data: payload,
      })
      .done(function (response) {
          Swal.fire(
          'Success!',
          _.get(response, "message", '{{__("Your transaction status has been changed to vendor nego.")}}'),
          'success'
          ).then(() => {
            $(".datatable-serverside").DataTable().destroy() 
            const datatable = initDatatable('.datatable-serverside');
            datatable.ajax.reload()
          });
      })
      .fail(function (err) {
          let message = '{{__("Your data failed to change status.")}}';

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
    }
  });
  // end assign mitra jasa

  // customer nego
  $(document).on('click', '.customer-nego-btn', function(event) {
    event.preventDefault();
    const url = $(this).attr("href");
    var payload = {
      status_transaksi: "CUSTOMER_NEGO"
    };
    $.ajax({
      url: url,
      type: "POST",
      data: payload,
    })
    .done(function (response) {
        Swal.fire(
        'Success!',
        _.get(response, "message", '{{__("Your transaction status has been changed to customer nego.")}}'),
        'success'
        ).then(() => {
          $(".datatable-serverside").DataTable().destroy() 
          const datatable = initDatatable('.datatable-serverside');
          datatable.ajax.reload()
        });
    })
    .fail(function (err) {
        let message = '{{__("Your data failed to change status.")}}';

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
  });
  // end customer nego

  // in progress (ieu fungsi sabenerna bsa di hijikeun jeung nu luhur wkwk)
  $(document).on('click', '.inprogress-btn', function(event) {
    event.preventDefault();
    const url = $(this).attr("href");
    var payload = {
      status_transaksi: "IN_PROGRESS"
    };
    $.ajax({
      url: url,
      type: "POST",
      data: payload,
    })
    .done(function (response) {
        Swal.fire(
        'Success!',
        _.get(response, "message", '{{__("Your transaction status has been changed to in progress.")}}'),
        'success'
        ).then(() => {
          $(".datatable-serverside").DataTable().destroy() 
          const datatable = initDatatable('.datatable-serverside');
          datatable.ajax.reload()
        });
    })
    .fail(function (err) {
        let message = '{{__("Your data failed to change status.")}}';

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
  });
  // end in progress

  // create invoice
  $(document).on('click', '.create-invoice-btn', function(event) {
    event.preventDefault();
    const url = $(this).attr("href");
    var payload = {
      status_transaksi: "NOT_PAID"
    };
    $.ajax({
      url: url,
      type: "POST",
      data: payload,
    })
    .done(function (response) {
        Swal.fire(
        'Success!',
        _.get(response, "message", '{{__("Create Invoice Success. Your transaction status has been changed to in NOT PAID.")}}'),
        'success'
        ).then(() => {
          $(".datatable-serverside").DataTable().destroy() 
          const datatable = initDatatable('.datatable-serverside');
          datatable.ajax.reload()
        });
    })
    .fail(function (err) {
        let message = '{{__("Your data failed to change status.")}}';

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
  });
  // end in progress
});
</script>
@endpush