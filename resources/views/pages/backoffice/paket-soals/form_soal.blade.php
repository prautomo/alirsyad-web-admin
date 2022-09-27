@csrf
<div class="row">
    <x-input.textarea :label="__('Soal')" name="soal" :data="$data" :placeholder="__('Apa bahasa inggris dari warna kuning?')" required />
    <x-input.textarea :label="__('Pilihan 1')" name="pilihan_a" :data="$data" :placeholder="__('Red')" required />
    <x-input.textarea :label="__('Pilihan 2')" name="pilihan_b" :data="$data" :placeholder="__('Green')" required />
    <x-input.textarea :label="__('Pilihan 3')" name="pilihan_c" :data="$data" :placeholder="__('Yellow')" required />
    <x-input.textarea :label="__('Pilihan 4')" name="pilihan_d" :data="$data" :placeholder="__('Blue')" required />
    <x-input.textarea :label="__('Pilihan 5')" name="pilihan_e" :data="$data" :placeholder="__('Black')" required />

    <x-input.select :label="__('Jawaban Benar')" id="jawaban" name="jawaban" :sources="$listJawabanBenar" :data="$data" required />

    <x-input.text :label="__('Sumber')" name="sumber" :data="$data" :placeholder="__('Wikipedia')" />
    <x-input.text :label="__('Link Pembahasan')" name="link_pembahasan" :data="$data" :placeholder="__('http://sample.com/wiki')" />
    <x-input.textarea :label="__('Pembahasan')" name="pembahasan" :data="$data" :placeholder="__('Lorem ipsum')" />

    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
        <button type="submit" class="btn btn-sm btn-primary">@lang("Save")</button>
        <a href="{{route("backoffice::paket-soals.index-soal", $paketId)}}" class="btn btn-sm btn-secondary mr-2">@lang("Cancel")</a>
    </div>
</div>
