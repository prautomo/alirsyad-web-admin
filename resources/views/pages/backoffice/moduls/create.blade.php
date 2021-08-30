<x-page.form :title="__('Create Modul')">
    {!! Form::open(array('route' => 'backoffice::moduls.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
        @include('pages.backoffice.moduls.form', ['data' => null])
    {!! Form::close() !!}
</x-page.form>