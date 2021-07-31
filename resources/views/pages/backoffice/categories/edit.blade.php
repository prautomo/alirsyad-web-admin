<x-page.form :title="__('Edit Kategori Materi')">
    <form action="{{route("backoffice::categories.update", $data->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @method('PUT')
        @include('pages.backoffice.categories.form', ['data' => $data])
    </form>
</x-page.form>