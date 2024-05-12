@props(['filterCol' => [], 'isMultiple' => [], 'customSearch' => 0])

<style>
    .form-group{
      display: inline-block;
      text-align: left;
    }

    select.form-control{
      width: 10rem;
      height: calc(1.5em + 1.25rem + 5px);
    }

    label{
        font-size: 10.8pt;
        text-align: left;
        margin-bottom: 0;
        color: #525f7f;
    }

    .dataTables_filter{
        width: 180%;
        text-align: right;
    }

    #ps-pembahasan-value{
        max-height: 25vh;
        overflow: auto;
    }
</style>
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
<script>
    MathJax = {
      tex: {
        inlineMath: [
          ["$", "$"],
          ["\\(", "\\)"]
        ],
        displayMath: [
          ["$$", "$$"],
          ["\\[", "\\]"]
        ]
      }
    };
</script>
<script
    id="MathJax-script"
    async
    src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"
></script>
@endpush
@endonce

@push('script')
<script>
    // filterCol = idx of column that able to filter, isMultiple = consider if its multiple value or not
    var filter_col = <?php echo json_encode($filterCol); ?>;
    var is_multiple = <?php echo json_encode($isMultiple); ?>;
    var is_custom_search = <?php echo $customSearch; ?>;
    var idx_loop = 0;

    filter_col = JSON.parse("[" + filter_col + "]");
    is_multiple = JSON.parse("[" + is_multiple + "]");

    $(document).ready(function () {

        const options = {
            paging: true,
            pageLength: 10,
            language: {
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data.",
                paginate: {
                    previous: "<i class='fa fa-chevron-left'></i>",
                    next: "<i class='fa fa-chevron-right'></i>",
                },
            },
        }

        if (is_custom_search) {
            options.dom = 'trip'
        }

        const datatable = initDatatable('.datatable-serverside', options);
        const datatableId = datatable.table().node().id;

        datatable.on('init', function ( e, settings, json ) {
            datatable.columns( filter_col ).every( function () {
                var column = this;
                var columnId = "div-filter-" + column.index();
                var columnHeader = column.header().textContent;

                $('<div id="' + columnId + '" class="form-group col-3">\
                    <label>'+ columnHeader +':</label>')
                    .appendTo( $('#filter-col'));

                var select = $('<select id="select-'+ columnId +'"class="form-control"><option value="">All</option></select>')
                    .appendTo( $('#'+ columnId +'') )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    });

                var all_options = []
                
                column.data().unique().sort().each( function ( d, j ) {
                    d = d.replace(/<[^>]*>?/gm, '')
                    
                    if(d == ''){
                        return true;
                    }

                    if(is_multiple[idx_loop] == 1){
                        var list_options = d.split(', ');
                        list_options.forEach(element => {
                            if(all_options.indexOf(element) == -1){
                                select.append('<option value="'+element+'">'+element+'</option>' )
                                all_options.push(element)
                            }
                        });
                    }else{
                        select.append('<option value="'+d+'">'+d+'</option>' )
                    }
                });

                $("#"+ datatableId +"_filter.dataTables_filter").prepend($("#" + columnId));
                idx_loop++;
            });
            
        });
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

        // Custom Search
        $('#search-dt-table').keyup(function(){
            datatable.search($(this).val()).draw() ;
        })

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

            console.log('soalll', soal)
            $('#ps-soal-value').html(soal.soal);
            $('#ps-pilihan1-value').html(soal.pilihan_a);
            $('#ps-pilihan2-value').html(soal.pilihan_b);
            $('#ps-pilihan3-value').html(soal.pilihan_c);
            $('#ps-pilihan4-value').html(soal.pilihan_d);
            $('#ps-pilihan5-value').html(soal.pilihan_e);
            $('#ps-pembahasan-value').html(soal.pembahasan);

            if(soal.pembahasan == null && soal.link_pembahasan != null){
                $('#ps-pembahasan-value').append(`<a href="${soal.link_pembahasan}" target="_blank">${soal.link_pembahasan}</a>`);
            }

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
            
            MathJax.startup.promise.then(() => {
                MathJax.typeset([$("#ps-soal-value")[0]]);
                MathJax.typeset([$("#ps-pilihan1-value")[0]]);
                MathJax.typeset([$("#ps-pilihan2-value")[0]]);
                MathJax.typeset([$("#ps-pilihan3-value")[0]]);
                MathJax.typeset([$("#ps-pilihan4-value")[0]]);
                MathJax.typeset([$("#ps-pilihan5-value")[0]]);
                MathJax.typeset([$("#ps-jawaban-value")[0]]);
                MathJax.typeset([$("#ps-pembahasan-value")[0]]);
            })
        });

        $(document).on('click', '.datatable-viewQR-btn', function(event) {
            event.preventDefault();
            const qr_data = $(this).data("qr");

            $('#previewQRCode').html(qr_data.qrcode);
            $('#previewQRCodeName').html(qr_data.name);
            $('#previewQRCodeNis').html(qr_data.nis);
            $('#previewQRCodeTingkat').html(qr_data.tingkat);
        });

        function svgDataURL(svgString) {
            return "data:image/svg+xml," + encodeURIComponent(svgString);
        }

        $(document).on('click', '.datatable-downloadQR-btn', function(event) {
            event.preventDefault();

            const captureElement = document.querySelector('#bodyPreviewQR')
            const qrItemName = $('#previewQRCodeName').text()
            const qrItemNis = $('#previewQRCodeNis').text()
            const qrItemTingkat = $('#previewQRCodeTingkat').text()

            html2canvas(captureElement)
                .then(canvas => {
                    canvas.style.display = 'none'
                    document.body.appendChild(canvas)
                    return canvas
                })
                .then(canvas => {
                    const image = canvas.toDataURL('image/png')
                    const a = document.createElement('a')
                    a.setAttribute('download', 'QR '+ qrItemName + ' ' + qrItemNis + ' ' + qrItemTingkat + '.png')
                    a.setAttribute('href', image)
                    a.click()
                    canvas.remove()
                })
        });

        $(document).on('click', '.datatable-printQR-btn', function(event) {
            event.preventDefault();
            var popUpAndPrint = function()
            {
                var svgQR = $('#previewQRCode');
                var name = $('#previewQRCodeName').html();
                var nis = $('#previewQRCodeNis').html();
                var tingkat = $('#previewQRCodeTingkat').html();
                var width = parseFloat(850)
                var height = parseFloat(850)
                var printWindow = window.open('', 'PrintMap',
                'width=' + width + ',height=' + height);

                var html = '';
                html += "<style>\
                    @import url('https://fonts.googleapis.com/css?family=Poppins');\
                    *{\
                        font-family: 'Poppins', sans-serif;\
                    }\
                    .text-title{\
                        margin-bottom: 0;\
                    }\
                    .text-sub-title{\
                        margin-top: 5px;\
                        font-weight: 400;\
                        margin-bottom: 25px;\
                    }\
                    .text-identity{\
                        margin-top: 0;\
                    }\
                    </style>"

                html += '<div style="display: flex; justify-content: center; align-items: center; height: 100%">';
                html += '<center>';
                html += "<h1 class='text-title'>Bismillah</h1>"
                html += "<h3 class='text-sub-title'>Silahkan Scan QR dibawah untuk login</h3>"
                html += $(svgQR).html()
                html += '<br/>'
                html += '<br/>'
                html += '<h3 class="text-identity">' + name + ' / ' + nis + ' / ' + tingkat + '</h3>'
                html += '</center>'
                html += '</div>';

                console.log('html', html)

                printWindow.document.writeln(html);
                printWindow.document.close();
                printWindow.print();
            };
            setTimeout(popUpAndPrint, 500);
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
                <h2 class="font-weight-bold mt-3">Pembahasan :</h2>
                <div id="ps-pembahasan-value">-</div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="viewQRModal" tabindex="-1" role="dialog" aria-labelledby="viewQRLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="viewQRLabel">Generate QR Code</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pt-0">
        <div class="row mt-2 text-center">
            <div class="col-md-12" id="bodyPreviewQR">
                <div id="previewQRCode" class="mb-3 mt-4"></div>
                <p class="font-weight-bold">
                    <span id="previewQRCodeName">-</span> /
                    <span id="previewQRCodeNis">-</span> /
                    <span id="previewQRCodeTingkat">-</span>
                </p>
            </div>
        </div>
      </div>
      <div class="modal-footer" style="justify-content: center;">
        <button type="button" class="btn btn-md btn-outline-primary datatable-printQR-btn">Cetak QR</button>
        <button type="button" class="btn btn-md btn-primary datatable-downloadQR-btn">Unduh QR</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="filterLabel">Filter</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pt-0">
        <div class="row mt-2 text-center">
            <div class="col-md-12">
                <div id="filter-col" class="row"></div>
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
