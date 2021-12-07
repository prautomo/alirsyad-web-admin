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

    <!-- <x-input.select :wrappingId="__('mapel')" :label="__('Guru Mata Pelajaran')" id="mata_pelajaran_id" name="mata_pelajaran_id" :sources="$mapelList" :data="$data" /> -->

    <div class="col-md-12" id="uploader">
        <div class="form-group">
            <label class="form-control-label" for="input-mapel">Mata Pelajaran</label>

            <select id="chooseMapel" multiple="multiple" name="mapel[]" class="form-control {{($errors->has('mapel') ? ' is-invalid' : '')}}">
                @foreach(@$mapelList as $idx => $mapel)

                @if(in_array($idx, $mapelIDS))
                <option value="{{ $idx }}" selected="true">{{ $mapel }}</option>
                @else
                <option value="{{ $idx }}">{{ $mapel }}</option>
                @endif 

                
                @endforeach
            </select>


            @if($errors->has('mapel'))
            <div class="invalid-feedback">
                <i class="fa fa-exclamation-circle fa-fw"></i> {{ $errors->first('mapel') }}
            </div>
            @endif
        </div>
    </div>

    <!-- <x-input.select :wrappingId="__('uploader')" :label="__('Uploader At')" id="uploader_jenjang_id" name="uploader_jenjang_id" :sources="$jenjangList" :data="$data" /> -->

    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
        <button type="submit" class="btn btn-sm btn-primary">@lang("Save")</button>
        <a href="{{route("backoffice::users.index", ['role' => \Request::get('role')])}}" class="btn btn-sm btn-secondary mr-2">@lang("Cancel")</a>
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

        @if(strtolower(\Request::get('role'))==="guru" || strtolower(!empty($userRole) ? array_keys(@$userRole)[0] : "" ) === "guru uploader")
        // hide uploader
        $("#uploader").show();
        @if(@$data->uploader_jenjang_id)
        $('select#uploader_jenjang_id').val({{$data->uploader_jenjang_id}});
        @endif
        @endif

        @if(!$data)
        var roleFirsChild = $('select#role').find("option:first-child").val();

        if(roleFirsChild.toLowerCase() === "guru uploader"){
            $("#uploader").show();
            @if(@$data->uploader_jenjang_id)
            $('select#uploader_jenjang_id').val({{$data->uploader_jenjang_id}});
            @endif
        }else{
            $("#uploader").hide();
        }
        @endif
    });
    
    $('select#role').on('change', function() {
        var value = this.value;

        console.log("dika guru", value)

        if(value.toLowerCase()==="guru uploader"){
            $("#uploader").show();
            @if(@$data->uploader_jenjang_id)
            $('select#uploader_jenjang_id').val({{$data->uploader_jenjang_id}});
            @endif
        }else{
            $("#uploader").hide();
        }
    });

</script>
@endpush