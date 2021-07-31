<x-page.form :title="__('Create Tingkat')">
    {!! Form::open(array('route' => 'backoffice::tingkats.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
        @include('pages.backoffice.tingkats.form', ['data' => null])
    {!! Form::close() !!}
</x-page.form>