@csrf
<div class="row">
    <x-input.select :label="__('Mata Pelajaran')" id="mata_pelajaran_id" name="mata_pelajaran_id" :sources="$mapelList" :data="$data" onchange="clickMapel(this)" required />

    <div class="col-md-12">
        <div class="form-group">
            <label class="form-control-label" for="input-modul">Bab Aktif</label>

            <select id="modul" multiple="multiple" name="modul[]" class="form-control {{($errors->has('modul') ? ' is-invalid' : '')}}" disabled>
                
            </select>


            @if($errors->has('modul'))
            <div class="invalid-feedback">
                <i class="fa fa-exclamation-circle fa-fw"></i> {{ $errors->first('modul') }}
            </div>
            @endif
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
        <button type="submit" class="btn btn-sm btn-primary">@lang("Save")</button>
        <a href="{{route("backoffice::moduls.index")}}" class="btn btn-sm btn-secondary mr-2">@lang("Cancel")</a>
    </div>
</div>


@push('plugin_script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#mata_pelajaran_id').select2();

        @if(@$data->pdf_path)
            let template = "<object type='application/pdf' width='100%' height='400px' data= '{{ asset($data->pdf_path) }}'>";

            $('#pdf-viewer-modul').html(template);
        @endif

        var coverUpdate = $("#coverUpdate");
        coverUpdate.hide();

        @if(@$update->logo)
            $("#showUpdate option[value='1']").prop('selected',true);
            coverUpdate.show();
        @endif
    });

    function clickMapel(e){
        var moduls = <?php echo json_encode($groupModulList); ?>;
        $('#modul').prop('disabled', false);

        var mata_pelajaran = $( "#mata_pelajaran_id option:selected" ).text();
        var tingkat = mata_pelajaran.substring(
            mata_pelajaran.indexOf("(") + 9, 
            mata_pelajaran.lastIndexOf(")")
        );

        var moduls_show = moduls.filter(function (modul) {
            return modul.text == tingkat;
        });

        $('#modul').empty();

        var s2 = $('#modul').select2({
            placeholder: "Please select modul",
            allowClear: true,
            width: '100%',
            data: moduls_show,
            theme: "classic",
        });
        // console.log( $('#modul').data)
    }

    $('select#showUpdate').on('change', function() {
        var coverUpdate = $("#coverUpdate");
        if(this.value==1){
            // show upload cover update
            coverUpdate.show();
        }else{
            // hide upload cover update
            coverUpdate.hide();
        }
    });

    $(document).ready(function() {
        console.log('sekali')
        // $('.js-example-basic-multiple').select2();
        var moduls = <?php echo json_encode($groupModulList); ?>

        var s2 = $('#modul').select2({
            placeholder: "Please select modul",
            allowClear: true,
            width: '100%',
            data: moduls,
            theme: "classic",
        });

        var vals = <?php echo json_encode($modulIDS); ?>;

        vals.forEach(function(e){
            if(!s2.find('option:contains(' + e + ')').length) 
            s2.append();
        });

        s2.val(vals).trigger("change"); 

        $('#modul').on('select2:open', function(e) {

        $('#select2-modul-results').on('click', function(event) {

            event.stopPropagation();
            var data = $(event.target).html();
            var selectedOptionGroup = data.toString().trim();

            var groupchildren = [];

            for (var i = 0; i < moduls.length; i++) {
                if (selectedOptionGroup.toString() === moduls[i].text.toString()) {
                    for (var j = 0; j < moduls[i].children.length; j++) {
                        groupchildren.push(moduls[i].children[j].id);
                    }
                }
            }

            var options = [];
            options = $('#modul').val();

            if (options === null || options === '') {

            options = [];

            }

            for (var i = 0; i < groupchildren.length; i++) {

                var count = 0;

                for (var j = 0; j < options.length; j++) {
                    if (options[j].toString() === groupchildren[i].toString()) {
                        count++;
                        break;
                    }
                }

                if (count === 0) {
                    options.push(groupchildren[i].toString());
                }
            }

            $('#modul').val(options);
            $('#modul').trigger('change'); // Notify any JS components that the value changed
            $('#modul').select2('close');    

        });
        });

        });

</script>
@endpush

@push('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@push('plugin_css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    li.select2-results__option strong.select2-results__group:hover {
    background-color: #ddd;
    cursor: pointer;
    }

</style>
@endpush
