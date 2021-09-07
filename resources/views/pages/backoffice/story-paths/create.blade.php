<x-page.form :title="__('Create Story Path')">
    {!! Form::open(array('route' => 'backoffice::story-paths.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
        @include('pages.backoffice.story-paths.form', ['data' => null])
    {!! Form::close() !!}
</x-page.form>