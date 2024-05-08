@csrf
<div class="row">
    <x-input.text :label="__('Title')" name="title" :data="$data" required />
    <!-- <x-input.textarea :label="__('Description')" name="description" :data="$data" required /> -->
    <x-input.images :label="__('Image')" name="image" :data="$data" required :helper="__('Size: 1000 x 250 px')" />

    <div class="col-md-12">
        <div class="form-group">
            @if(@$data)
            <label class="form-control-label" for="input-file">File PDF</label>
            @else
            <label class="form-control-label" for="input-file">File PDF (*)</label>
            @endif
            <input id="file" type="file" accept="application/pdf" name="file" placeholder="File PDF" value="{{old('file') ?? $data['file'] ?? '' ?? ''}}" class="form-control {{($errors->has('file') ? ' is-invalid' : '')}}" }}>

            @if($errors->has('file'))
            <div class="invalid-feedback">
                <i class="fa fa-exclamation-circle fa-fw"></i> {{ $errors->first('file') }}
            </div>
            @endif
            
            <div id="pdf-viewer-file"></div>
        </div>
    </div>

    <x-input.text type="number" :label="__('Urutan')" name="urutan" :data="$data" required />

    <div class="col-md-12">
        <div class="form-group">
            <label class="form-control-label" for="input-activeStatus">Show Banner</label>
            <br/>
            <select id="activeStatus" name="activeStatus" data-style="btn-light" class="selectpicker {{($errors->has('activeStatus') ? ' is-invalid' : '')}}">
                @foreach($activeStatus as $val => $label)
                <option value="{{ $val }}" {{ ((int)$val==(int) @$data['activeStatus']) ? ' selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>

            @if($errors->has('activeStatus'))
            <div class="invalid-feedback">
                <i class="fa fa-exclamation-circle fa-fw"></i> {{ $errors->first('activeStatus') }}
            </div>
            @endif
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
        <button type="submit" class="btn btn-sm btn-primary">@lang("Save")</button>
        <a href="{{route("backoffice::banners.index")}}" class="btn btn-sm btn-secondary mr-2">@lang("Cancel")</a>
    </div>
</div>


@push('plugin_script')
<script type="text/javascript">
    $(document).ready(function() {

        @if(@$data->file)
            let template = "<object type='application/pdf' width='100%' height='400px' data= '{{ asset($data->file) }}'>";
            
            $('#pdf-viewer-file').html(template);
        @endif
    });

    $('#file').on('change', function(e){ 
        let files = e.target?.files ?? [];
        
        if (files.length >= 1) {
            let fileUrl = URL.createObjectURL(files[0]);
            let template = "<object type='application/pdf' width='100%' height='400px' data= '" + fileUrl + "'>";
            
            $('#pdf-viewer-file').html(template);
        }
    });
</script>
@endpush
