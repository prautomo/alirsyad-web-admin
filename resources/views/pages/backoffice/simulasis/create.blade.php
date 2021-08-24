<x-page.form :title="__('Create Simulasi')">
    {!! Form::open(array('route' => 'backoffice::simulasis.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
        @include('pages.backoffice.simulasis.form', ['data' => null])
    {!! Form::close() !!}
</x-page.form>