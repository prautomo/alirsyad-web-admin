<x-page.form :title="__('Edit Promo')">
    <form action="{{route("backoffice::promos.update", $data->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @method('PUT')
        @include('pages.backoffice.promos.form', ['data' => $data])
    </form>
</x-page.form>