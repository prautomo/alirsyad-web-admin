<x-page.form :title="__('Create Latihan Soal')">
    {!! Form::open(array('route' => 'backoffice::latihan-soal.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
        @include('pages.backoffice.latihan-soal.form', ['data' => null])
    {!! Form::close() !!}
</x-page.form>