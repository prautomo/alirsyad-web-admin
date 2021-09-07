@csrf
<div class="row">

    <div id="form-story-path" cancel-link="{{route("backoffice::story-paths.index")}}" class="col-md-12">Loading...</div>

</div>


@push('plugin_script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#modul_id').select2();
    });

    var simulasis = [];

    $('select#modul_id').on('change', function() {
        simulasis = [];
        loadSimulasi( this.value );
    });

    function loadSimulasi(modulId){
        console.log("modul", modulId);

        simulasis.push("adaw");
        console.log("modul", simulasis);
        // $.ajax({
        //     type:'GET',
        //     url:"{{route("backoffice::kelas.listJson")}}",
        //     data:"q_modul_id=" + modulId,
        //     success: function(res){ 
        //         $('#kelas').html("");
        //         for(var i=0; i<res.length; i++){
        //             var kelas = res[i];
        //             if(kelas.id==selectedId){
        //                 $('#kelas').append($('<option selected>').val(kelas.id).text(kelas.name));
        //             }else{
        //                 $('#kelas').append($('<option>').val(kelas.id).text(kelas.name));
        //             }
        //         }
        //     }
        // }); 
    }
</script>
@endpush

@push('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@push('plugin_css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush