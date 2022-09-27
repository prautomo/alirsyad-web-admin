<x-page.form :title="__('Create Soal')">
    {!! Form::open(array('route' => ['backoffice::paket-soals.store-soal', $paketId],'method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
        @include('pages.backoffice.paket-soals.form_soal', ['data' => null])
    {!! Form::close() !!}
</x-page.form>
