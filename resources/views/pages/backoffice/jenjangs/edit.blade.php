<x-page.form :title="__('Edit Jenjang')">
    <form action="{{route("backoffice::jenjangs.update", $data->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @method('PUT')
        @include('pages.backoffice.jenjangs.form', ['data' => $data])
    </form>
</x-page.form>