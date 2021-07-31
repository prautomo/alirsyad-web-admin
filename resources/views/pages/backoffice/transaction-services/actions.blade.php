@if(isset($showRoute))
<a href="{{ $showRoute }}" class="btn btn-sm btn-icon btn-success">
    <i class="fa fa-eye"></i>
    {{__("Show")}}
</a>
@endif

@if(isset($surveiRoute))
<a href="{{$surveiRoute}}" class="btn btn-sm btn-icon btn-primary survei-btn">
    <i class="fa fa-user"></i>
    {{__("Survey")}}
</a>
@endif

@if(isset($assignRoute))
<a href="{{$assignRoute}}" data-sub_service_id="{{$sub_service_id ?? ""}}" class="btn btn-sm btn-icon btn-primary assign-mitra-btn">
    <i class="fa fa-user"></i>
    {{__("Assign Mitra")}}
</a>
@endif

@if(isset($customerNegoRoute))
<a href="{{$customerNegoRoute}}" class="btn btn-sm btn-icon btn-primary customer-nego-btn">
    <i class="fa fa-user"></i>
    {{__("Customer Nego")}}
</a>
@endif

@if(isset($inProgressRoute))
<a href="{{$inProgressRoute}}" class="btn btn-sm btn-icon btn-primary inprogress-btn">
    <i class="fa fa-user"></i>
    {{__("In Progress")}}
</a>
@endif

@if(isset($createInvoiceRoute))
<a href="{{$createInvoiceRoute}}" class="btn btn-sm btn-icon btn-primary create-invoice-btn">
    <i class="fa fa-user"></i>
    {{__("Create Invoice")}}
</a>
@endif

@if(isset($cancelRoute))
<a href="{{$cancelRoute}}" data-name="{{$name ?? ""}}" class="btn btn-sm btn-icon btn-danger cancel-btn">
    <i class="fa fa-times-circle"></i>
    {{__("Cancel")}}
</a>
@endif