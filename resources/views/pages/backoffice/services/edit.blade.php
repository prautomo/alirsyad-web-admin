<x-page.form :title="__('Edit Service')">
    <form action="{{route("backoffice::services.update", $data->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @method('PUT')
        @include('pages.backoffice.services.form', ['data' => $data])
    </form>
</x-page.form>
