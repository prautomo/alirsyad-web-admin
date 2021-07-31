<x-page.form :title="__('Edit Sub Service')">
    <form action="{{route("backoffice::sub-services.update", ['serviceId' => $serviceId, 'id' => $data->id])}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @method('PUT')
        @include('pages.backoffice.sub-services.form', ['data' => $data])
    </form>
</x-page.form>
