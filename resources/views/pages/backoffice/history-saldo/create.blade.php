<x-page.form :title="__('Add Saldo '.$user->name)">
    {!! Form::open(array('route' => ['backoffice::history-saldo.store', ['userId' => $userId]],'method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
        @include('pages.backoffice.history-saldo.form', ['data' => null])
    {!! Form::close() !!}
</x-page.form>