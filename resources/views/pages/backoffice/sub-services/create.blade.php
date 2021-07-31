<x-page.form :title="__('Create Sub Service')">
    {!! Form::open(array('route' => ['backoffice::sub-services.store', ['serviceId' => $serviceId]],'method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
        @include('pages.backoffice.sub-services.form', ['data' => null])
    {!! Form::close() !!}
</x-page.form>
