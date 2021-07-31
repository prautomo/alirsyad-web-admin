<x-page.form :title="__('Edit Kelas')">
    <form action="{{route("backoffice::kelas.update", $data->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @method('PUT')
        @include('pages.backoffice.kelas.form', ['data' => $data])
    </form>
</x-page.form>