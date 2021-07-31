<x-page.form :title="__('Create Article')">
    {!! Form::open(array('route' => 'backoffice::articles.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
        @include('pages.backoffice.articles.form', ['data' => null])
    {!! Form::close() !!}
</x-page.form>