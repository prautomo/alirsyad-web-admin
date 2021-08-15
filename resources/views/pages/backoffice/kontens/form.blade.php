@csrf
<div class="row">
    <x-input.text :label="__('Name')" name="name" :data="$data" required />

    <div class="col-md-12">
        <div class="form-group">
            <label class="form-control-label" for="input-game">File Game (*)</label>
            <input id="game" type="file" name="game" placeholder="File Game" value="{{old('game') ?? $data['game'] ?? '' ?? ''}}" class="form-control {{($errors->has('game') ? ' is-invalid' : '')}}" }}>

            @if($errors->has('game'))
            <div class="invalid-feedback">
                <i class="fa fa-exclamation-circle fa-fw"></i> {{ $errors->first('game') }}
            </div>
            @endif
        </div>
    </div>

    <x-input.textarea :label="__('Description')" name="description" :data="$data" />

    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
        <button type="submit" class="btn btn-sm btn-primary">@lang("Save")</button>
        <a href="{{route("backoffice::kontens.index")}}" class="btn btn-sm btn-secondary mr-2">@lang("Cancel")</a>
    </div>
</div>