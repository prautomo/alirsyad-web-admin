<x-page.form :title="__('Naik Kelas')">
    <form action="{{route("backoffice::external-users.next_grade_update")}}" method="POST" class="form-horizontal" enctype="multipart/form-data" onsubmit="return checkClassMatch(this)">
        @csrf
        <div class="row">

            {{-- Tingkat dan Kelas SEBELUMNYA --}}
            <x-input.select :label="__('Tingkat Sebelumnya')" id="prev_tingkat_id" name="prev_tingkat_id" :sources="$tingkatList" required />
            
            <!-- Dropdown Kelas -->
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-control-label" for="input-prev-kelas">Kelas Sebelumnya (*)</label>

                    <select id="prev_kelas_id" name="prev_kelas_id" class="form-control {{($errors->has('prev-kelas') ? ' is-invalid' : '')}}" required>
                        <option value="" selected>Pilih kelas</option>
                    </select>

                    @if($errors->has('kelas'))
                    <div class="invalid-feedback">
                        <i class="fa fa-exclamation-circle fa-fw"></i> {{ $errors->first('prev-kelas') }}
                    </div>
                    @endif
                </div>
            </div>
            {{-- end --}}

            {{-- Tingkat dan Kelas SELANJUTNYA --}}
            <x-input.select :label="__('Naik Tingkat Baru')" id="next_tingkat_id" name="next_tingkat_id" :sources="$tingkatList" required />
            <input type="hidden" id="selected_student_list" name="selected_student_list">
            
            <!-- Dropdown Kelas -->
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-control-label" for="input-next-kelas">Naik Kelas Baru (*)</label>

                    <select id="next_kelas_id" name="next_kelas_id" class="form-control {{($errors->has('next-kelas') ? ' is-invalid' : '')}}" required>
                        <option value="" selected>Pilih kelas</option>
                    </select>

                    @if($errors->has('kelas'))
                    <div class="invalid-feedback">
                        <i class="fa fa-exclamation-circle fa-fw"></i> {{ $errors->first('next-kelas') }}
                    </div>
                    @endif
                </div>
            </div>
            {{-- end --}}

            
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-control-label" for="input-next-kelas">Daftar Siswa (*)</label>

                    <select id="select_student_id" name="selected_students[]" multiple="multiple" class="form-control {{($errors->has('next-kelas') ? ' is-invalid' : '')}}" required>
                        
                    </select>

                    @if($errors->has('kelas'))
                    <div class="invalid-feedback">
                        <i class="fa fa-exclamation-circle fa-fw"></i> {{ $errors->first('next-kelas') }}
                    </div>
                    @endif
                </div>
            </div>

            <x-input.text :label="__('Jumlah Siswa yang Sudah Dipilih')" name="total_selected" value=0 readonly/>
            <x-input.text :label="__('Jumlah Siswa yang Belum Dipilih')" name="total_unselected" value=0 readonly/>


            <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                <button type="submit" class="btn btn-sm btn-primary">@lang("Save")</button>
                <a href="{{route("backoffice::external-users.index", ['role' => $role ]) }}" class="btn btn-sm btn-secondary mr-2">@lang("Cancel")</a>
            </div>
        </div>
    </form>


    @push('plugin_script')
    <script type="text/javascript">
        var selected_student_list = [];
        $(document).ready(function() {
            $('#prev_tingkat_id').select2();
            $('#next_tingkat_id').select2();
            $('#prev_kelas_id').select2();
            $('#next_kelas_id').select2();
            
            var s2 = $('#select_student_id').select2({
                multiple: true,
                placeholder: "Pilih siswa",
                allowClear: true,
                width: '100%',
                theme: "classic",
            });
        });

        $("#select_student_id")
            .on("select2:selecting", function (e) {
                var selected_idx = e.params.args.data.element.index;
                var option = this.options[selected_idx]
                $(option).prop("disabled", true);

                selected_student_list.push(e.params.args.data.id);

                var total_selected = parseInt($('#total_selected').val());
                $('#total_selected').val(++total_selected);

                var total_unselected = parseInt($('#total_unselected').val());
                $('#total_unselected').val(--total_unselected);
            });


        $("#select_student_id")
            .on("select2:unselecting", function (e) {
                var unselected_idx = e.params.args.data.element.index;
                var option = this.options[unselected_idx]
                $(option).prop("disabled", false); 

                selected_student_list = selected_student_list.filter(function(item) {
                    return item !== e.params.args.data.id
                })

                var total_selected = parseInt($('#total_selected').val());
                $('#total_selected').val(--total_selected);

                var total_unselected = parseInt($('#total_unselected').val());
                $('#total_unselected').val(++total_unselected);
            });

        $('select#prev_tingkat_id').on('change', function() {
            if(this.value){
                loadKelas(this.value, "prev_kelas_id");
                $('#total_selected').val(0);
                $('#total_unselected').val(0);
            }
        });

        $('select#next_tingkat_id').on('change', function() {
            if(this.value){
                loadKelas(this.value, "next_kelas_id");
            }
        });

        function loadKelas(tingkatId, classSelectId){
            $.ajax({
                type:'GET',
                url:"{{route("backoffice::kelas.listJson")}}",
                data:"q_tingkat_id=" + tingkatId,
                success: function(res){ 
                    $('#' + classSelectId).html("");
                    $('#' + classSelectId).append($('<option>').val("").text("Pilih kelas"));

                    for(var i=0; i<res.length; i++){
                        var kelas = res[i];
                        $('#' + classSelectId).append($('<option>').val(kelas.id).text(kelas.name));
                    }
                }
            }); 
        }

        $('select#prev_kelas_id').on('change', function() {
            if(this.value){
                $('#total_selected').val(0);
                $('#total_unselected').val(0);
                loadSiswa(this.value);
            }
        });

        function loadSiswa(kelasId){
            $.ajax({
                type:'GET',
                url:"{{route("backoffice::external-users.listSiswaJson")}}",
                data:"q_kelas_id=" + kelasId,
                success: function(res){ 
                    $('#select_student_id').html("");
                    $('#select_student_id').append($('<option>').val("").text("Pilih Siswa"));

                    for(var i=0; i<res.length; i++){
                        var siswa = res[i];
                        $('#select_student_id').append($('<option>').val(siswa.id).text(siswa.name));
                    }

                    $('#total_unselected').val(res.length);
                }
            }); 
        }

        function checkClassMatch(form){
            $('#selected_student_list').val(selected_student_list);

            var prev_tingkat = $('#prev_tingkat_id').val();
            var next_tingkat = $('#next_tingkat_id').val();

            var prev_kelas = $('#prev_kelas_id').val();
            var next_kelas = $('#next_kelas_id').val();
            if((prev_tingkat == next_tingkat) || (prev_kelas == next_kelas)){
                
                Swal.fire({
                    icon: 'warning',
                    title: "Gagal!",
                    text:  "Tingkat/Kelas Sebelum dan Tingkat/Kelas Baru Harus Berbeda!",
                    showCloseButton: true,
                    type: "warning",
                    timer: 2500,
                    showConfirmButton: false
                })
                return false
            }
            return
        }
    </script>
    @endpush

    @push('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @endpush

    @push('plugin_css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        li.select2-results__option strong.select2-results__group:hover {
        background-color: #ddd;
        cursor: pointer;
        }

    </style>
    @endpush
</x-page.form>
