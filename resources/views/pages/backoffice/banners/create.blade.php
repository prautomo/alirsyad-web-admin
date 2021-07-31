<x-page.form :title="__('Create Banner')">
    {!! Form::open(array('route' => 'backoffice::banners.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
        @include('pages.backoffice.banners.form', ['data' => null])
    {!! Form::close() !!}
</x-page.form>