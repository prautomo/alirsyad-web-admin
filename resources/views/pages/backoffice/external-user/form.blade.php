@csrf
<div class="row">
    @php
    $data['role'] = empty($data) ? \Request::get('role', 'CUSTOMER') : $data['role']; 
    @endphp
    <x-input.text :label="__('Role')" type="hidden" name="role" :data="$data" />
    <x-input.text :label="__('Name')" name="name" :data="$data" required />
    <x-input.text :label="__('Username')" name="username" :data="$data" required />
    @if(empty(@$data['password']))
    <x-input.text :label="__('Password')" type="password" name="password" :data="$data" required />
    @endif
    <x-input.text :label="__('Email')" type="email" name="email" :data="$data" />
    <x-input.text :label="__('Phone')" name="phone" :data="$data" />
    <x-input.textarea :label="__('Address')" name="address" :data="$data" />
    <x-input.images :label="__('Photo')" name="photo" :data="$data"/>

    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
        <button type="submit" class="btn btn-sm btn-primary">@lang("Save")</button>
        <a href="{{route("backoffice::external-users.index", ['role' => $data['role']])}}" class="btn btn-sm btn-secondary mr-2">@lang("Cancel")</a>
    </div>
</div>