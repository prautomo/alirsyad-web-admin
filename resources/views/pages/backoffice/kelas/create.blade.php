<x-page.form :title="__('Create Kelas')">
    {!! Form::open(array('route' => 'backoffice::kelas.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
        @include('pages.backoffice.kelas.form', ['data' => null])
    {!! Form::close() !!}
</x-page.form>