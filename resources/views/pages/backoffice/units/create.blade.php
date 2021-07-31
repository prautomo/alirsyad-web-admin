<x-page.form :title="__('Create Unit')">
    {!! Form::open(array('route' => 'backoffice::units.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
        @include('pages.backoffice.units.form', ['data' => null])
    {!! Form::close() !!}
</x-page.form>