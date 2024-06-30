@extends('layouts.backoffice')

@section('title', 'Generate QR Code')

@section('header')
  @parent

    <div class="row align-items-center py-4">

        @can('external-user-create')
        <div class="col-lg-6 col-7">
        </div>

        <div class="col-lg-6 col-5 text-right">
            @if(count($data) > 0)
                <button type="button" class="btn btn-md btn-primary table-printQR-bulk-btn">
                    Generate All QR Code
                </button>
            @endif
        </div>
        @endcan
    </div>
@endsection

@section('content')

    @if(count($data) > 0)

        <!-- tble -->
        <div class="table table-responsive">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                <tr>
                    <th >
                        <input type="checkbox" id="selectAllSiswa" name="selectAllSiswa" value="all"/>&nbsp;
                    </th>
                    <th scope="col" class="sort" data-sort="no">No</th>
                    <th scope="col" class="sort" data-sort="nis">NIS</th>
                    <th scope="col" class="sort" data-sort="name">Nama</th>
                    <th scope="col" class="sort" data-sort="jenjang">Jenjang</th>
                    <th scope="col" class="sort" data-sort="tingkat">Tingkat</th>
                    <th scope="col" class="sort" data-sort="kelas">Kelas</th>
                    <th scope="col" class="sort" data-sort="tahun_ajaran">Tahun Ajaran</th>
                </tr>
                </thead>
                <tbody class="list">
                @foreach ($data as $key => $item)
                    <tr>
                    <td><input type="checkbox" id="{{ $item->id }}" name="selectedSiswa[]" value="{{ $item->id }}"></td>
                    <td>{{ ++$key }}</td>
                    <td>{{ $item->nis }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->kelas->tingkat->jenjang->name }}</td>
                    <td>{{ $item->kelas->tingkat->name }}</td>
                    <td>{{ $item->kelas->name }}</td>
                    <td>{{ $item->tahun_ajaran }}</td>
                    <td hidden>
                        <div class="col-md-12" id="bodyPreviewQR{{ $item->id }}">
                            <div id="previewQRCode{{ $item->id }}" class="mb-3 mt-4">
                                {{ $item->qr['qrcode'] }}
                            </div>
                            <p class="font-weight-bold">
                                <span id="previewQRCodeName{{ $item->id }}">
                                    {{ $item->qr['name'] }}
                                </span> /
                                <span id="previewQRCodeNis{{ $item->id }}">
                                    {{ $item->qr['nis'] }}    
                                </span> /
                                <span id="previewQRCodeTingkat{{ $item->id }}">
                                    {{ $item->qr['tingkat'] }}    
                                </span>
                            </p>
                        </div>
                    </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
    <div class="row">
        <div class="col-12 d-flex justify-content-center align-items-center" style="min-height: 70vh; flex-direction: column;">
            <h2>Silahkan pilih kelas, jenjang dan Tingkat untuk menampilkan Data Siswa</h2>
            <a href="/backoffice/external-users?role=SISWA&is_pengunjung=0" class="btn btn-md btn-primary mt-3">
                Kembali
              </a>
        </div>
    </div>
    @endif
@endsection

@push('style')
<style>

    @media print {
        .pagebreak { page-break-before: always; } /* page-break-after works, as well */
    }

</style>
@endpush

@push('script')
<script>

    $(document).ready(function() {
        $(".header").removeClass("pb-6");
        $(".header").addClass("mb-6");
    });

    $(document).on('click', '#selectAllSiswa', function(event) {
        if(this.checked) {
            // Iterate each checkbox
            $('input[name="selectedSiswa[]"]:checkbox').each(function() {
                this.checked = true;                        
            });
        } else {
            $('input[name="selectedSiswa[]"]:checkbox').each(function() {
                this.checked = false;                       
            });
        }
    });

    $(document).on('click', '.table-printQR-bulk-btn', function(event) {
        event.preventDefault();

        var selected_siswa = [];
        $('input[name="selectedSiswa[]"]:checked').each(function(item){
            selected_siswa[item] = $(this).val();
        });

        var popUpAndPrint = function()
        {
            var html = ""
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

            var width = parseFloat(850)
            var height = parseFloat(850)
            var printWindow = window.open('', 'PrintMap',
            'width=' + width + ',height=' + height);

            selected_siswa.forEach(item => {
                var svgQR = $(`#previewQRCode${item}`);
                var name = $(`#previewQRCodeName${item}`).html();
                var nis = $(`#previewQRCodeNis${item}`).html();
                var tingkat = $(`#previewQRCodeTingkat${item}`).html();

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
                html += '<div style="break-after:page"></div>'
            });

            printWindow.document.writeln(html);
            printWindow.document.close();
            printWindow.print();
        };
        setTimeout(popUpAndPrint, 500);

    });
</script>
@endpush