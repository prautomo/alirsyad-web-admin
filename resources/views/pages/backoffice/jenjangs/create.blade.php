<x-page.form :title="__('Create Jenjang')">
    {!! Form::open(array('route' => 'backoffice::jenjangs.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
        @include('pages.backoffice.jenjangs.form', ['data' => null])
    {!! Form::close() !!}
</x-page.form>