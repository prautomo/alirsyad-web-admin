<x-page.form :title="__('Edit Article')">
    <form action="{{route("backoffice::articles.update", $data->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @method('PUT')
        @include('pages.backoffice.articles.form', ['data' => $data])
    </form>
</x-page.form>