@can(isset($permissionName).'-show')
    @if(isset($showRoute))
    <a href="{{ $showRoute }}" class="btn btn-sm btn-icon btn-success">
        <i class="fa fa-eye"></i>
        {{__("Show")}}
    </a>
    @endif
@endcan

@if(isset($subRoute))
<a href="{{ $subRoute }}" class="btn btn-sm btn-icon btn-success">
    <i class="fa fa-eye"></i>
    {{__("Sub")}}
</a>
@endif

@can(isset($permissionName).'-edit')
    @if(isset($editRoute))
    <a href="{{ $editRoute }}" class="btn btn-sm btn-icon btn-primary" data-role="form-modal">
        <i class="fa fa-pencil-alt"></i>
        {{__("Edit")}}
    </a>
    @endif
@endcan

@can(isset($permissionName).'-delete')
    @if(isset($deleteRoute))
    <a href="{{$deleteRoute}}" data-name="{{$name ?? ""}}" class="btn btn-sm btn-icon btn-danger datatable-delete-btn">
        <i class="far fa-trash-alt"></i>
        {{__("Remove")}}
    </a>
    @endif
@endcan

@if(isset($statusRequestDanaRoute))
<a href="{{$statusRequestDanaRoute}}" data-name="{{$name ?? ""}}" data-status="{{$status ?? ""}}" class="btn btn-sm btn-icon btn-primary datatable-status-dana-btn">
    <i class="fa fa-pencil-alt"></i>
    {{__("Change Status")}}
</a>
@endif

@if(isset($saldoRoute) || isset($productRoute))
<!-- gakepake -->
<div class="btn-group" role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        More
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
        @if(isset($saldoRoute))
        <a class="dropdown-item" href="{{$saldoRoute}}">History Saldo</a>
        @endif
        @if(isset($productRoute) && \Request::get('role')=="MITRA")
        <a class="dropdown-item" href="{{$productRoute}}">Product List</a>
        @endif
    </div>
</div>
@endif

@if(isset($copySlug))
<a href="#" data-slug="{{$copySlug ?? ''}}" class="btn btn-sm btn-icon btn-warning" id="datatable-copy-btn">
    <i class="far fa-copy"></i>
    {{__("Copy Slug")}}
</a>
@endif