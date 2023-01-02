<x-page.form :title="__('Create Paket Soal')">
    {!! Form::open(array('route' => 'backoffice::paket-soals.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
        @include('pages.backoffice.paket-soals.form', ['data' => null])
    {!! Form::close() !!}
</x-page.form>
