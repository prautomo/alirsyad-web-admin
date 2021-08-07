<x-page.form :title="__('Create Mata Pelajaran')">
    {!! Form::open(array('route' => 'backoffice::mata_pelajarans.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
        @include('pages.backoffice.mata_pelajarans.form', ['data' => null])
    {!! Form::close() !!}
</x-page.form>