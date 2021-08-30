<x-page.form :title="__('Create Video')">
    {!! Form::open(array('route' => 'backoffice::videos.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
        @include('pages.backoffice.videos.form', ['data' => null])
    {!! Form::close() !!}
</x-page.form>