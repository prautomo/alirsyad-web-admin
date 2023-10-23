@csrf
<div class="row">
    <x-input.textarea :label="__('Soal')" id="soal" name="soal" :data="$data" :placeholder="__('Apa bahasa inggris dari warna kuning?')" required />
    <x-input.textarea :label="__('Pilihan 1')" id="pilihan_a" name="pilihan_a" :data="$data" :placeholder="__('Red')" required />
    <x-input.textarea :label="__('Pilihan 2')" id="pilihan_b" name="pilihan_b" :data="$data" :placeholder="__('Green')" required />
    <x-input.textarea :label="__('Pilihan 3')" id="pilihan_c" name="pilihan_c" :data="$data" :placeholder="__('Yellow')" required />
    <x-input.textarea :label="__('Pilihan 4')" id="pilihan_d" name="pilihan_d" :data="$data" :placeholder="__('Blue')" required />
    <x-input.textarea :label="__('Pilihan 5')" id="pilihan_e" name="pilihan_e" :data="$data" :placeholder="__('Black')" required />

    <x-input.select :label="__('Jawaban Benar')" id="jawaban" name="jawaban" :sources="$listJawabanBenar" :data="$data" required />

    <x-input.text :label="__('Sumber')" name="sumber" :data="$data" :placeholder="__('Wikipedia')" />
    <x-input.text :label="__('Link Pembahasan')" name="link_pembahasan" :data="$data" :placeholder="__('http://sample.com/wiki')" />
    <x-input.textarea :label="__('Pembahasan')" id="pembahasan" name="pembahasan" :data="$data" :placeholder="__('Lorem ipsum')" />

    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
        <button type="submit" class="btn btn-sm btn-primary">@lang("Save")</button>
        <a href="{{route("backoffice::paket-soals.index-soal", $paketId)}}" class="btn btn-sm btn-secondary mr-2">@lang("Cancel")</a>
    </div>
</div>

@push('plugin_script')
<!-- <script src="{{ asset('backoffice/assets/vendor/ckeditor/ckeditor.js') }}"></script> -->
<script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
@endpush

@push('script')
<script type="text/javascript">
    CKEDITOR.replace( 'soal', {
        filebrowserUploadUrl: "{{route('backoffice::upload.imageCKEditor', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    } );

    CKEDITOR.replace( 'pilihan_a', {
        filebrowserUploadUrl: "{{route('backoffice::upload.imageCKEditor', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    } );

    CKEDITOR.replace( 'pilihan_b', {
        filebrowserUploadUrl: "{{route('backoffice::upload.imageCKEditor', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    } );

    CKEDITOR.replace( 'pilihan_c', {
        filebrowserUploadUrl: "{{route('backoffice::upload.imageCKEditor', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    } );

    CKEDITOR.replace( 'pilihan_d', {
        filebrowserUploadUrl: "{{route('backoffice::upload.imageCKEditor', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    } );

    CKEDITOR.replace( 'pilihan_e', {
        filebrowserUploadUrl: "{{route('backoffice::upload.imageCKEditor', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    } );

    CKEDITOR.replace( 'pembahasan', {
        filebrowserUploadUrl: "{{route('backoffice::upload.imageCKEditor', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    } );
</script>
@endpush

