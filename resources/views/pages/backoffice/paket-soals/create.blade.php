<x-page.form :title="__('Create Paket Soal')">
    {!! Form::open(array('route' => 'backoffice::paket-soals.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
        @php
            $default = ['max_show_answer_key' => 80, 'answer_key_type' => 'persentase'];
        @endphp
        @include('pages.backoffice.paket-soals.form', ['data' => $default])
    {!! Form::close() !!}
</x-page.form>
