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
            navigator.clipboard?.writeText(slug);
            
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
</script>
@endpush
