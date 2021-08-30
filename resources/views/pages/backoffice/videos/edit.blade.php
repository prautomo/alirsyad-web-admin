<x-page.form :title="__('Edit Video')">
    <form action="{{route("backoffice::videos.update", $data->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @method('PUT')
        @include('pages.backoffice.videos.form', ['data' => $data])
    </form>
</x-page.form>