<table {{$attributes->merge(["class" => "datatable-serverside table datatable"])}}>
    <thead>
        <tr>
            {{$slot}}
        </tr>
    </thead>
</table>

@once
@push('plugin_css')
<link rel="stylesheet" href="{{ asset('backoffice/assets/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">

<style>
    .ps-soal-preview img {
        width: 100% !important;
        height: 100% !important;
    }
</style>
@endpush
@push('plugin_script')
<script src="{{ asset('backoffice/assets/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backoffice/assets/js/dataTables.bootstrap.js') }}"></script>
@endpush
@endonce

@push('script')
<script>
    $(document).ready(function () {
        const datatable = initDatatable('.datatable-serverside');

        function copyToClipboard(text) {
            if (window.clipboardData && window.clipboardData.setData) {
                // Internet Explorer-specific code path to prevent textarea being shown while dialog is visible.
                return window.clipboardData.setData("Text", text);
            }
            else if (document.queryCommandSupported && document.queryCommandSupported("copy")) {
                var textarea = document.createElement("textarea");
                textarea.textContent = text;
                textarea.style.position = "fixed";  // Prevent scrolling to bottom of page in Microsoft Edge.
                document.body.appendChild(textarea);
                textarea.select();
                try {
                    return document.execCommand("copy");  // Security exception may be thrown by some browsers.
                }
                catch (ex) {
                    console.warn("Copy to clipboard failed.", ex);
                    return false;
                }
                finally {
                    document.body.removeChild(textarea);
                }
            }
        }

        // copy slug
        $(document).on('click', '#datatable-copy-btn', function(event) {
            event.preventDefault();
            const slug = $(this).data("slug");

            /* Copy the text inside the text field */
            copyToClipboard(slug);

            alert("Copied the text: " + slug);
        });

        $(document).on('click', '.datatable-delete-btn', function(event) {
            event.preventDefault();
            const url = $(this).attr("href");
            const name = $(this).data("name");
            const text = "{{__("Are you sure you want to delete :name?")}}";

            if (url) {
                Swal.fire({
                    title: "Confirmation",
                    text: text.replace(":name", name || "{{__("this item")}}"),
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "{{__("Delete")}}"
                })
                .then(result => {
                    if (result.value) {
                        $.ajax({
                            url: url,
                            type: "DELETE"
                        })
                        .done(function (response) {
                            Swal.fire(
                            'Deleted!',
                            _.get(response, "message", '{{__("Your data has been deleted.")}}'),
                            'success'
                            ).then(() => datatable.ajax.reload());
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

        $(document).on('click', '.datatable-viewPdf-btn', function(event) {
            event.preventDefault();
            const url = $(this).data("url");

            let template = "<object type='application/pdf' width='100%' height='400px' data= '"+ url +"'>";

            $('#previewContent').html(template);
        });

        $(document).on('click', '.datatable-viewSoal-btn', function(event) {
            event.preventDefault();
            const soal = $(this).data("soal");

            $('#ps-soal-value').html(soal.soal);
            $('#ps-pilihan1-value').html(soal.pilihan_a);
            $('#ps-pilihan2-value').html(soal.pilihan_b);
            $('#ps-pilihan3-value').html(soal.pilihan_c);
            $('#ps-pilihan4-value').html(soal.pilihan_d);
            $('#ps-pilihan5-value').html(soal.pilihan_e);

            let jawaban = "Pilihan E";
            switch (soal.jawaban) {
                case "pilihan_a":
                    jawaban = "Pilihan A"
                    break;
                case "pilihan_b":
                    jawaban = "Pilihan B"
                    break;
                case "pilihan_c":
                    jawaban = "Pilihan C"
                    break;
                case "pilihan_d":
                    jawaban = "Pilihan D"
                    break;
            }

            $('#ps-jawaban-value').html(jawaban);
        });

        $(document).on('click', '.datatable-status-dana-btn', function(event) {
            event.preventDefault();
            const url = $(this).attr("href");
            const name = $(this).data("name");
            const status = $(this).data("status");
            const text = "{{__("Are you sure you want to change status :name?")}}";

            var listStatus = {};
            if(status==="NEW"){
                listStatus = {
                    'PROCESS': 'Process',
                    'REJECT': 'Reject'
                }
            }else if(status==="PROCESS"){
                listStatus = {
                    'DONE': 'Done',
                    'REJECT': 'Reject'
                }
            }

            if (url) {
                Swal.fire({
                    title: 'Select Status',
                    input: 'select',
                    inputOptions: listStatus,
                    inputPlaceholder: 'Select a status',
                    showCancelButton: true,
                    inputValidator: (value) => {
                        return new Promise((resolve) => {
                            if (value === 'PROCESS' || value === 'REJECT' || value === 'DONE') {
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
                                resolve('You need to select status :)')
                            }
                        })
                    }
                })
            }
        });
    });

    // change status modal
    function changeStatus(id, role, route){
        Swal.fire({
            title: 'Select Status',
            input: 'select',
            inputOptions: {
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
                            status: value,
                            role: role
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


    // change status password reset modal
    function changeStatusPasswordReset(id, role, route){
        Swal.fire({
            title: 'Select Status',
            input: 'select',
            inputOptions: {
                'RESET_PASSWORD_SELESAI': 'Reset Password',
                'RESET_PASSWORD_DITOLAK': 'Tolak Permintaan Reset Password'
            },
            inputPlaceholder: 'Select a status',
            showCancelButton: true,
            inputValidator: (value) => {
                return new Promise((resolve) => {
                    if (value === 'RESET_PASSWORD_SELESAI' || value === 'RESET_PASSWORD_DITOLAK') {
                        var url = route
                        var payload = {
                            status: value,
                            role: role
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
                        resolve('You need to select RESET_PASSWORD_SELESAI or RESET_PASSWORD_DITOLAK :)')
                    }
                })
            }
        })
    }
</script>

<div class="modal fade" id="viewPdfModal" tabindex="-1" role="dialog" aria-labelledby="viewPdfModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewPdfModalLabel">Preview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pt-0">
        <div id="previewContent"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="viewSoalModal" tabindex="-1" role="dialog" aria-labelledby="viewSoalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="viewSoalLabel">Preview Soal</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pt-0 ps-soal-preview">
        <div class="row">
            <div class="col-md-12">
                <h2 class="font-weight-bold">Soal :</h2>
                <div id="ps-soal-value">-</div>
                <h2 class="font-weight-bold">Pilihan A :</h2>
                <div id="ps-pilihan1-value">-</div>
                <h2 class="font-weight-bold">Pilihan B :</h2>
                <div id="ps-pilihan2-value">-</div>
                <h2 class="font-weight-bold">Pilihan C :</h2>
                <div id="ps-pilihan3-value">-</div>
                <h2 class="font-weight-bold">Pilihan D :</h2>
                <div id="ps-pilihan4-value">-</div>
                <h2 class="font-weight-bold">Pilihan E :</h2>
                <div id="ps-pilihan5-value">-</div>
                <h2 class="font-weight-bold">Jawaban :</h2>
                <div id="ps-jawaban-value">-</div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endpush
