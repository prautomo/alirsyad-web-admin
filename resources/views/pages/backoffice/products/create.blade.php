<x-page.form :title="__('Add Product '.$user->name)">
    {!! Form::open(array('route' => ['backoffice::products.store', ['userId' => $userId]],'method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
        @include('pages.backoffice.products.form', ['data' => null])
    {!! Form::close() !!}
</x-page.form>