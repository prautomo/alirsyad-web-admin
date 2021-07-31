<x-page.form :title="__('Create Sub Category')">
    {!! Form::open(array('route' => ['backoffice::sub_categories.store', ['categoryId' => $categoryId]],'method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
        @include('pages.backoffice.sub_categories.form', ['data' => null])
    {!! Form::close() !!}
</x-page.form>