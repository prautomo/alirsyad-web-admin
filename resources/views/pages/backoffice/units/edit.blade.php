<x-page.form :title="__('Edit Unit')">
    <form action="{{route("backoffice::units.update", $data->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @method('PUT')
        @include('pages.backoffice.units.form', ['data' => $data])
    </form>
</x-page.form>