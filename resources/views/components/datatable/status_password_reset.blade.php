@php
    if($text=='MENUNGGU'){
        $badge = "warning";
    } else if($text=='RESET_PASSWORD_SELESAI') {
        $badge = "success";
    }else {
        $badge = "danger";
    }
@endphp

<span class="badge badge-{{$badge}}" onClick="changeStatusPasswordReset({{$id}}, '{{$role}}', '{{$route}}')" style="cursor: pointer;" title="Change Status">{{$text}}</span>