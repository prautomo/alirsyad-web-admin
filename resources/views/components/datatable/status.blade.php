@php
    if($text=='BELUM_DIKONFIRMASI'){
        $badge = "warning";
    } else if($text=='AKTIF') {
        $badge = "success";
    }else {
        $badge = "danger";
    }
@endphp

<span class="btn btn-sm btn-{{$badge}}" onClick="changeStatus({{$id}}, '{{$role}}', '{{$route}}')" style="cursor: pointer;" title="Change Status">{{$text}}</span>