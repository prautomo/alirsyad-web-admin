<x-page.form :title="__('Create User')">
    {!! Form::open(array('route' => 'backoffice::users.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
        @include('pages.backoffice.users.form', ['data' => null])
    {!! Form::close() !!}
</x-page.form>