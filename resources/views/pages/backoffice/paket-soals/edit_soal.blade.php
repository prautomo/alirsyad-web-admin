<x-page.form :title="__('Edit Soal')">
    <form action="{{route("backoffice::paket-soals.update-soal", [@$data->paket_soal_id, @$data->id])}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @method('PUT')
        @include('pages.backoffice.paket-soals.form_soal', ['data' => $data])
    </form>
</x-page.form>
