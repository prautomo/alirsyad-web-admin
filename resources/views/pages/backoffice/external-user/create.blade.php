<x-page.form :title="__('Create External User')">
    {!! Form::open(array('route' => ['backoffice::external-users.store'], 'method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
        @include('pages.backoffice.external-user.form', ['data' => null])
    {!! Form::close() !!}
</x-page.form>