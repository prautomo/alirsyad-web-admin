<x-page.form :title="__('Create Promo')">
    {!! Form::open(array('route' => 'backoffice::promos.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
        @include('pages.backoffice.promos.form', ['data' => null])
    {!! Form::close() !!}
</x-page.form>