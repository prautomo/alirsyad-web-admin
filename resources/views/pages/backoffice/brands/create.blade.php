<x-page.form :title="__('Create Brand')">
    {!! Form::open(array('route' => 'backoffice::brands.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
        @include('pages.backoffice.brands.form', ['data' => null])
    {!! Form::close() !!}
</x-page.form>