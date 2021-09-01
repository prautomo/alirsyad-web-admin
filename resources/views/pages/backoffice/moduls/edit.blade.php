<x-page.form :title="__('Edit Modul')">
    <form action="{{route("backoffice::moduls.update", $data->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @method('PUT')
        @include('pages.backoffice.moduls.form', ['data' => $data])
    </form>
</x-page.form>