@csrf
<div class="row">
    <x-input.text :label="__('Product Name')" name="name" :data="$data" required />
    <x-input.textarea :label="__('Description')" name="description" :data="$data" required />
    <x-input.text :label="__('Price')" type="number" name="price" :data="$data" required />
    <x-input.text :label="__('Stock')" type="number" name="stock" :data="$data" />
    <x-input.text :label="__('Selling Price')" type="number" name="selling_price" :data="$data" required />
    <x-input.text :label="__('Discount')" type="number" name="discount" :data="$data" />
    <x-input.textarea :label="__('Spesification')" name="spesification" :data="$data" />
    <x-input.textarea :label="__('Keunggulan')" name="keunggulan" :data="$data" />

    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
        <button type="submit" class="btn btn-sm btn-primary">@lang("Save")</button>
        <a href="{{route("backoffice::products.index", ['userId' => $userId])}}" class="btn btn-sm btn-secondary mr-2">@lang("Cancel")</a>
    </div>
</div>