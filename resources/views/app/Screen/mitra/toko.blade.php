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

                    <div class="card text-left col-lg-12 mb-4" >
                        <div class="card-body">
                            <div class="d-flex  align-items-center">

                                <img src="{{$user_data->photo}}" width="100px" class="img-fluid rounded-circle" alt="">

                                <div class="d-flex flex-column ml-5">
                                    <h4>{{$user_data->name}}</h4>
                                    <h5 class="text-muted">{{$user_data->email}}</h4>

                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card text-left col-lg-12">
                    
                        <div class="card-body pl-1 pr-1" id="toko-transaction-list-container">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="spacer"> </div>

@endsection