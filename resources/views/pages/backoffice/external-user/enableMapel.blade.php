<x-page.form :title="__('Enable Access Mata Pelajaran Guest User')">
    <form action="{{route("backoffice::external-users.enableMapelUpdate", $data->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-control-label" for="input-mapel">Mata Pelajaran</label>

                    <select id="mapel" multiple="multiple" name="mapel[]" class="js-example-basic-multiple form-control {{($errors->has('mapel') ? ' is-invalid' : '')}}">
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

            <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                <button type="submit" class="btn btn-sm btn-primary">@lang("Save")</button>
                <a href="{{route("backoffice::external-users.index", ['role' => $data['role'], 'is_pengunjung' => 1])}}" class="btn btn-sm btn-secondary mr-2">@lang("Cancel")</a>
            </div>
        </div>
    </form>

    @push('plugin_css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush


    @push('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @endpush

    @push('plugin_script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
    @endpush
</x-page.form>