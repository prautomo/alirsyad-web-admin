<x-page.form :title="__('Create Akses Modul')">
    {!! Form::open(array('route' => 'backoffice::manage-external-users.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
        @include('pages.backoffice.manage-external-user.form', ['data' => null])
    {!! Form::close() !!}
</x-page.form>