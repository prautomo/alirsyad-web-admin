<x-page.form :title="__('Create Payment Method')">
    {!! Form::open(array('route' => 'backoffice::payment-methods.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
        @include('pages.backoffice.payment-method.form', ['data' => null])
    {!! Form::close() !!}
</x-page.form>
