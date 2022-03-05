<x-page.form :title="$title">
    {!! Form::open(array('route' => 'backoffice::manage-external-users.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
        @include('pages.backoffice.manage-external-user.form', ['data' => null, 'content' => $content])
    {!! Form::close() !!}
</x-page.form>