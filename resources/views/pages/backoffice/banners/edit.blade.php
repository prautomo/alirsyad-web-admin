<x-page.form :title="__('Edit Banner')">
    <form action="{{route("backoffice::banners.update", $data->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @method('PUT')
        @include('pages.backoffice.banners.form', ['data' => $data])
    </form>
</x-page.form>