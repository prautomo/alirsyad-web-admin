@csrf
<div class="row">
    <x-input.text :label="__('Amount')" type="number" name="amount" :data="$data" required />
    <x-input.textarea :label="__('Description')" name="description" :data="$data" />

    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
        <button type="submit" class="btn btn-sm btn-primary">@lang("Save")</button>
        <a href="{{route("backoffice::history-saldo.index", ['userId' => $userId])}}" class="btn btn-sm btn-secondary mr-2">@lang("Cancel")</a>
    </div>
</div>