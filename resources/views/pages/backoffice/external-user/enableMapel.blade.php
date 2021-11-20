<x-page.form :title="__('Enable Access Mata Pelajaran Guest User')">
    <form action="{{route("backoffice::external-users.enableMapelUpdate", $data->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-control-label" for="input-mapel">Mata Pelajaran</label>

                    <select id="mapel" multiple="multiple" name="mapel[]" class="form-control {{($errors->has('mapel') ? ' is-invalid' : '')}}">
                        
                    </select>


                    @if($errors->has('mapel'))
                    <div class="invalid-feedback">
                        <i class="fa fa-exclamation-circle fa-fw"></i> {{ $errors->first('mapel') }}
                    </div>
                    @endif
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                <button type="submit" class="btn btn-sm btn-primary">@lang("Save")</button>
                <a href="{{route("backoffice::external-users.index", ['role' => $data['role'], 'is_pengunjung' => 1])}}" class="btn btn-sm btn-secondary mr-2">@lang("Cancel")</a>
            </div>
        </div>
    </form>

    @push('plugin_css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        li.select2-results__option strong.select2-results__group:hover {
        background-color: #ddd;
        cursor: pointer;
        }

    </style>
    @endpush


    @push('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @endpush

    @push('plugin_script')
    <script type="text/javascript">
        $(document).ready(function() {
            // $('.js-example-basic-multiple').select2();

            var countries = <?php echo json_encode($mapelList); ?>

            var s2 = $('#mapel').select2({
                placeholder: "Please select mapel",
                allowClear: true,
                width: '100%',
                data: countries,
                theme: "classic",
            });

            var vals = <?php echo json_encode($mapelIDS); ?>;

            vals.forEach(function(e){
                if(!s2.find('option:contains(' + e + ')').length) 
                s2.append();
            });

            s2.val(vals).trigger("change"); 

        $('#mapel').on('select2:open', function(e) {

        $('#select2-mapel-results').on('click', function(event) {

            event.stopPropagation();
            var data = $(event.target).html();
            var selectedOptionGroup = data.toString().trim();

            var groupchildren = [];

            for (var i = 0; i < countries.length; i++) {
                if (selectedOptionGroup.toString() === countries[i].text.toString()) {
                    for (var j = 0; j < countries[i].children.length; j++) {
                        groupchildren.push(countries[i].children[j].id);
                    }
                }
            }

            var options = [];
            options = $('#mapel').val();

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

            $('#mapel').val(options);
            $('#mapel').trigger('change'); // Notify any JS components that the value changed
            $('#mapel').select2('close');    

        });
        });

        });
    </script>
    @endpush
</x-page.form>