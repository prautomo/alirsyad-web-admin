@extends("app/layout")

@section('content')
<div class="spacer"> </div>
<div class="container">
    <div class="d-flex flex-column align-items-start" style="margin-top: 100px;">
        <div class="mb-4 mt-4 prod-page-header">
            <h3>Profile</h3>
        </div>
        <div class="row" style="width: 100%;">
            @include("app.Screen.customer.sidebar")
            <div class="col-lg-9">
                <div class="row">

                    
                    
                    <div class="card text-left col-lg-12">
                    
                        <div class="card-body pl-1 pr-1" id="jasa-transaction-list-container" status="{{$status}}">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="spacer"> </div>

@endsection