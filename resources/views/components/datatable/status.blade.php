@php
    if($text=='BELUM_DIKONFIRMASI'){
        $badge = "warning";
    } else if($text=='AKTIF') {
        $badge = "success";
    }else {
        $badge = "danger";
    }
@endphp

<span class="badge badge-{{$badge}}" onClick="changeStatus({{$id}}, '{{$role}}', '{{$route}}')" style="cursor: pointer;" title="Change Status">{{$text}}</span>