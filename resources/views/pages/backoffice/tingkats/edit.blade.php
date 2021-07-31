<x-page.form :title="__('Edit Tingkat')">
    <form action="{{route("backoffice::tingkats.update", $data->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @method('PUT')
        @include('pages.backoffice.tingkats.form', ['data' => $data])
    </form>
</x-page.form>