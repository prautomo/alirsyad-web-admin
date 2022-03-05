@csrf
<div class="row">
    
    <input type="text" value="{{ $content }}" name="contentType" class="form-control" hidden />

    <x-input.select :label="__('Mata Pelajaran')" id="id" name="id" :sources="$mapelList" :data="$data" onchange="clickMapel(this)" required />

    <div class="col-md-12">
        <div class="form-group">
            <label class="form-control-label" for="input-content">Bab Aktif</label>

            <select id="content" multiple="multiple" name="content[]" class="form-control {{($errors->has('content') ? ' is-invalid' : '')}}"  {{($form_mode == 'create' ? ' disabled' : '')}}>
                
            </select>


            @if($errors->has('content'))
            <div class="invalid-feedback">
                <i class="fa fa-exclamation-circle fa-fw"></i> {{ $errors->first('content') }}
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
        $('#id').select2();

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
        var contents = <?php echo json_encode($groupContentList); ?>;
        $('#content').prop('disabled', false);

        var mata_pelajaran = $( "#id option:selected" ).text();
        console.log(mata_pelajaran)

        var contents_show = contents.filter(function (content) {
            return content.text == mata_pelajaran;
        });

        $('#content').empty();

        var s2 = $('#content').select2({
            placeholder: "Please select content",
            allowClear: true,
            width: '100%',
            data: contents_show,
            theme: "classic",
        });
        // console.log( $('#content').data)
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
        var contents = <?php echo json_encode($groupContentList); ?>

        $('#content').prop('disabled', false);

        var mata_pelajaran = $( "#id option:selected" ).text();

        var contents_show = contents.filter(function (content) {
            return content.text == mata_pelajaran;
        });

        $('#content').empty();

        var s2 = $('#content').select2({
            placeholder: "Please select content",
            allowClear: true,
            width: '100%',
            data: contents_show,
            theme: "classic",
        });

        var vals = <?php echo json_encode($contentIDS); ?>;

        vals.forEach(function(e){
            if(!s2.find('option:contains(' + e + ')').length) 
            s2.append();
        });

        s2.val(vals).trigger("change"); 

        $('#content').on('select2:open', function(e) {

        $('#select2-content-results').on('click', function(event) {

            event.stopPropagation();
            var data = $(event.target).html();
            var selectedOptionGroup = data.toString().trim();

            var groupchildren = [];

            for (var i = 0; i < contents.length; i++) {
                if (selectedOptionGroup.toString() === contents[i].text.toString()) {
                    for (var j = 0; j < contents[i].children.length; j++) {
                        groupchildren.push(contents[i].children[j].id);
                    }
                }
            }

            var options = [];
            options = $('#content').val();

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

            $('#content').val(options);
            $('#content').trigger('change'); // Notify any JS components that the value changed
            $('#content').select2('close');    

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
