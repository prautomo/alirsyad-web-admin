<x-page.form :title="__('Edit Product')">
    <form action="{{route("backoffice::products.update", ['userId' => $userId, 'id' => $data->id])}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @method('PUT')
        @include('pages.backoffice.products.form', ['data' => $data])
    </form>
</x-page.form>