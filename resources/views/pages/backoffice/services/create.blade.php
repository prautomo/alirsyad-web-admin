<x-page.form :title="__('Create Service')">
    {!! Form::open(array('route' => 'backoffice::services.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
        @include('pages.backoffice.services.form', ['data' => null])
    {!! Form::close() !!}
</x-page.form>
