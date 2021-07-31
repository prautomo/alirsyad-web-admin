<x-page.form :title="__('Create Kategori Materi')">
    {!! Form::open(array('route' => 'backoffice::categories.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
        @include('pages.backoffice.categories.form', ['data' => null])
    {!! Form::close() !!}
</x-page.form>