<x-page.form :title="__('Edit Brand')">
    <form action="{{route("backoffice::brands.update", $data->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @method('PUT')
        @include('pages.backoffice.brands.form', ['data' => $data])
    </form>
</x-page.form>