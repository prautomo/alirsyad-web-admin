<x-page.form :title="__('Create Konten')">
    {!! Form::open(array('route' => 'backoffice::kontens.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
        @include('pages.backoffice.kontens.form', ['data' => null])
    {!! Form::close() !!}
</x-page.form>