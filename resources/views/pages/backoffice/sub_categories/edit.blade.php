<x-page.form :title="__('Edit Sub Category')">
    <form action="{{route("backoffice::sub_categories.update", ['categoryId' => $categoryId, 'id' => $data->id])}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @method('PUT')
        @include('pages.backoffice.sub_categories.form', ['data' => $data])
    </form>
</x-page.form>