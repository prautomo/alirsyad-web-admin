@csrf
<div class="row">
    <x-input.text :label="__('Username')" name="username" :data="$data" required />
    <x-input.text :label="__('Name')" name="name" :data="$data" required />
    <x-input.text :label="__('Email')" type="email" name="email" :data="$data" required />
    @if($data)
    <x-input.text :label="__('Password')" type="password" name="password" />
    <x-input.text :label="__('Confirm Password')" type="password" name="confirm-password" />
    @else
    <x-input.text :label="__('Password')" type="password" name="password" required />
    <x-input.text :label="__('Confirm Password')" type="password" name="confirm-password" required />
    @endif

    @if(strtolower(\Request::get('role'))!=="gurus")
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-control-label" for="input-role">Role</label>
            @if(@$userRole)
            {!! Form::select('roles[]', $roles, $userRole, array('class' => 'form-control', 'id' => 'role')) !!}
            @else
            {!! Form::select('roles[]', $roles, ['role'=>\Request::get('role')], array('class' => 'form-control', 'id' => 'role')) !!}
            @endif
        </div>
    </div>
    @endif

    <x-input.select :wrappingId="__('mapel')" :label="__('Guru Mata Pelajaran')" id="mata_pelajaran_id" name="mata_pelajaran_id" :sources="$mapelList" :data="$data" />

    <x-input.select :wrappingId="__('uploader')" :label="__('Uploader At')" id="uploader_tingkat_id" name="uploader_tingkat_id" :sources="$tingkatList" :data="$data" />

    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
        <button type="submit" class="btn btn-sm btn-primary">@lang("Save")</button>
        <a href="{{route("backoffice::users.index")}}" class="btn btn-sm btn-secondary mr-2">@lang("Cancel")</a>
    </div>
</div>


@push('script')
<style>
#uploader {
    display: none;
}
</style>

<script>
    // onload
    $(function(){

        @if(strtolower(\Request::get('role'))==="guru" || strtolower(!empty($userRole) ? array_keys(@$userRole)[0] : "" ) === "guru")
        // hide uploader
        $("#uploader").show();
        @if(@$data->uploader_tingkat_id)
        $('select#uploader_tingkat_id').val({{$data->uploader_tingkat_id}});
        @endif
        @endif

        @if(!$data)
        var roleFirsChild = $('select#role').find("option:first-child").val();

        if(roleFirsChild.toLowerCase() === "guru"){
            $("#uploader").show();
            @if(@$data->uploader_tingkat_id)
            $('select#uploader_tingkat_id').val({{$data->uploader_tingkat_id}});
            @endif
        }else{
            $("#uploader").hide();
        }
        @endif
    });
    
    $('select#role').on('change', function() {
        var value = this.value;

        if(value.toLowerCase()==="guru"){
            $("#uploader").show();
            @if(@$data->uploader_tingkat_id)
            $('select#uploader_tingkat_id').val({{$data->uploader_tingkat_id}});
            @endif
        }else{
            $("#uploader").hide();
        }
    });

</script>
@endpush