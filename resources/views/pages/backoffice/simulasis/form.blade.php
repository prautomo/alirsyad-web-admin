@csrf
<div class="row">
    <x-input.select :label="__('Mata Pelajaran')" id="mata_pelajaran_id" name="mata_pelajaran_id" :sources="$mapelList" :data="$data" required />

    <div class="col-md-12">
        <div class="form-group">
            @if(@$data)
            <label class="form-control-label" for="input-game">File Simulasi</label>
            @else
            <label class="form-control-label" for="input-game">File Simulasi (*)</label>
            @endif
            <input id="game" type="file" name="game" placeholder="File Simulasi" value="{{old('game') ?? $data['game'] ?? '' ?? ''}}" class="form-control {{($errors->has('game') ? ' is-invalid' : '')}}" }}>

            @if($errors->has('game'))
            <div class="invalid-feedback">
                <i class="fa fa-exclamation-circle fa-fw"></i> {{ $errors->first('game') }}
            </div>
            @endif

            @if(@$data->path_simulasi)
            <a href="{{ asset($data->path_simulasi) }}/index.html" target="_blank">Lihat Simulasi</a>
            @endif
        </div>
    </div>

    <x-input.text :label="__('Name')" name="name" :data="$data" required />
    <x-input.textarea :label="__('Description')" name="description" :data="$data" />
    <x-input.images :label="__('Cover Simulasi')" name="icon" :data="$data" />

    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
        <button type="submit" class="btn btn-sm btn-primary">@lang("Save")</button>
        <a href="{{route("backoffice::simulasis.index")}}" class="btn btn-sm btn-secondary mr-2">@lang("Cancel")</a>
    </div>
</div>


@push('plugin_script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#mata_pelajaran_id').select2();
    });
</script>
@endpush

@push('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@push('plugin_css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush