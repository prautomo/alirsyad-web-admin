<x-page.form :title="__('Edit Mata Pelajaran')">
    <form action="{{route("backoffice::mata_pelajarans.update", $data->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @method('PUT')
        @include('pages.backoffice.mata_pelajarans.form', ['data' => $data])
    </form>
</x-page.form>