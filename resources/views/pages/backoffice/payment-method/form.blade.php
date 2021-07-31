@csrf
<div class="row">
    <x-input.text :label="__('Name')" name="name" :data="$data" required />
    <x-input.text :label="__('Bank')" name="bank" :data="$data" required />
    <x-input.text :label="__('Account Number')" name="account_number" :data="$data" required />
    <x-input.text :label="__('Account Holder Name')" name="account_holder_name" :data="$data" required />
    <x-input.images :label="__('Image')" :width="__('250px')" :height="__('250px')" name="image_url" :data="$data" required />

    @php
    $scPG = [
        'IPAYMU' => 'iPaymu',
    ];
    @endphp
    <x-input.select :label="__('Payment Gateway')" name="pg_gateway" :sources="$scPG" :data="$data" required />

    <x-input.text :label="__('Payment Gateway Type')" name="pg_type" :data="$data" required />
    <x-input.text :label="__('Payment Gateway Method')" name="pg_payment_method" :data="$data" required />

    <x-input.text :label="__('Percent Cost')" type="number" step="0.01" name="percent_cost" :data="$data" />
    <x-input.text :label="__('Nominal Cost')" type="number" name="nominal_cost" :data="$data" />

    @php
    $source = [
        '0' => 'Disable',
        '1' => 'Enable',
    ];
    @endphp
    <x-input.select :label="__('Status')" name="is_enabled" :sources="$source" :data="$data" required />

    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
        <button type="submit" class="btn btn-sm btn-primary">@lang("Save")</button>
        <a href="{{route("backoffice::brands.index")}}" class="btn btn-sm btn-secondary mr-2">@lang("Cancel")</a>
    </div>
</div>
