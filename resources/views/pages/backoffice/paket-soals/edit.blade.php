<x-page.form :title="__('Edit Paket Soal')">
    <form action="{{route("backoffice::paket-soals.update", $data->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @method('PUT')
        @include('pages.backoffice.paket-soals.form', ['data' => $data])
    </form>
</x-page.form>
