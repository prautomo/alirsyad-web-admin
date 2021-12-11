<x-page.form :title="__('Edit Profile')">
    {!! Form::open(array('route' => 'backoffice::akun-saya.profile-update','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
        @csrf
        <div class="row">
            @php
            $data['role'] = empty($data) ? \Request::get('role', 'SISWA') : $data['role']; 
            @endphp
            
            <x-input.text :label="__('NIP')" name="nis" :data="$data" required />

            <x-input.text :label="__('Name')" name="name" :data="$data" required />

            <x-input.text :label="__('Email')" type="email" name="email" :data="$data" required />
            
            @if(@$mapelIDS)
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-control-label" for="input-mapel">Mata Pelajaran</label>

                    <select id="chooseMapel" multiple="multiple" name="mapel[]" class="form-control {{($errors->has('mapel') ? ' is-invalid' : '')}}">
                        @foreach(@$mapelList as $idx => $mapel)

                            @if(in_array($idx, $mapelIDS))
                            <option value="{{ $idx }}" selected="true">{{ $mapel }}</option>
                            @else
                            <option value="{{ $idx }}">{{ $mapel }}</option>
                            @endif 
                        
                        @endforeach
                    </select>


                    @if($errors->has('mapel'))
                    <div class="invalid-feedback">
                        <i class="fa fa-exclamation-circle fa-fw"></i> {{ $errors->first('mapel') }}
                    </div>
                    @endif
                </div>
            </div>

            <div class="col-md-12 d-none">
                <div class="form-group">
                    <label class="form-control-label" for="input-is_uploader">Guru Uploader</label>

                    <select{{ ((int)1==(int) @$data['is_uploader']) ? ' disabled' : '' }} id="is_uploader" name="is_uploader" class="form-control {{($errors->has('is_uploader') ? ' is-invalid' : '')}}">
                        @foreach(@$isUploader as $val => $label)
                        <option value="{{ $val }}" {{ ((int)$val==(int) @$data['is_uploader']) ? ' selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>

                    @if($errors->has('is_uploader'))
                    <div class="invalid-feedback">
                        <i class="fa fa-exclamation-circle fa-fw"></i> {{ $errors->first('is_uploader') }}
                    </div>
                    @endif
                </div>
            </div>
            @endif

            @if(@\Auth::user()->hasRole('Guru Uploader'))
            <x-input.text :label="__('Phone')" name="phone" :data="$data" />
            <x-input.textarea :label="__('Address')" name="address" :data="$data" />
            @endif
            
            <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                <button type="submit" class="btn btn-sm btn-primary">@lang("Save")</button>
                <a href="{{route("backoffice::external-users.index", ['role' => $data['role']])}}" class="btn btn-sm btn-secondary mr-2">@lang("Cancel")</a>
            </div>
        </div>


        @push('plugin_script')
        <script type="text/javascript">
            $(document).ready(function() {
                $('#chooseMapel').select2();

                @if(@$mapelIDS)
                    $('#chooseMapel').select2({
                        theme: "classic",
                        width: 'resolve',
                    });
                @endif
            });
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
    {!! Form::close() !!}
</x-page.form>