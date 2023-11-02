<x-page.form :title="__('Create External User')">
    {!! Form::open(array('route' => ['backoffice::external-users.next_grade_update'], 'method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
    @csrf
    <div class="row">

        {{-- Tingkat dan Kelas SEBELUMNYA --}}
        <x-input.select :label="__('Tingkat Sebelumnya')" id="prev_tingkat" name="prev_tingkat_id" :sources="$tingkatList" required />
        
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
        <x-input.select :label="__('Naik Tingkat')" id="next_tingkat_id" name="next_tingkat_id" :sources="$tingkatList" required />
        
        <!-- Dropdown Kelas -->
        <div class="col-md-12">
            <div class="form-group">
                <label class="form-control-label" for="input-next-kelas">Naik Kelas (*)</label>

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

        <div class="col-xs-12 col-sm-12 col-md-12 text-right">
            <button type="submit" class="btn btn-sm btn-primary">@lang("Save")</button>
            <a href="{{route("backoffice::moduls.index")}}" class="btn btn-sm btn-secondary mr-2">@lang("Cancel")</a>
        </div>
    </div>
    {!! Form::close() !!}

    @push('plugin_script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#prev_tingkat_id').select2();
            $('#next_tingkat_id').select2();
            $('#prev_kelas_id').select2();
            $('#next_kelas_id').select2();
            
            var s2 = $('#select_student_id').select2({
                placeholder: "Pilih siswa",
                allowClear: true,
                width: '100%',
                theme: "classic",
            });
        });

        $('select#prev_tingkat_id').on('change', function() {
            if(this.value){
                loadKelas(this.value, "prev_kelas_id");
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
                        var kelas = res[i];
                        $('#select_student_id').append($('<option>').val(kelas.id).text(kelas.name));
                    }
                }
            }); 
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
