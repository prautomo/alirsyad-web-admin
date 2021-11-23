@csrf
<div class="row">
    <x-input.text :label="__('Name')" name="name" :data="$data" required />
    <x-input.textarea :label="__('Description')" name="description" :data="$data" />
    <x-input.select :label="__('Guru Uploader')" id="uploader_id" name="uploader_id" :sources="$uploaderList" :data="$data" />
    
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-control-label" for="input-show_for_guest">Show on Register</label>

            <select id="show_for_guest" name="show_for_guest" class="form-control {{($errors->has('show_for_guest') ? ' is-invalid' : '')}}">
                @foreach($showForGuest as $val => $label)
                <option value="{{ $val }}" {{ ((int)$val==(int) $data['show_for_guest']) ? ' selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>

            @if($errors->has('show_for_guest'))
            <div class="invalid-feedback">
                <i class="fa fa-exclamation-circle fa-fw"></i> {{ $errors->first('show_for_guest') }}
            </div>
            @endif
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
        <button type="submit" class="btn btn-sm btn-primary">@lang("Save")</button>
        <a href="{{route("backoffice::jenjangs.index")}}" class="btn btn-sm btn-secondary mr-2">@lang("Cancel")</a>
    </div>
</div>