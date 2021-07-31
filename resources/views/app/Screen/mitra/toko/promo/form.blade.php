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
            <div class="card text-left col-lg-9">

                <div class="card-body pl-1 pr-1">
                    <div class="card border-none  " style="background-color: transparent;" id="form-promo" action="{{$action}}" form-data="{{json_encode($formData)}}">
                        Sedang Memuat
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <div class="spacer"> </div>
    @endsection


    @section("js")
    <script>
        function deleteItem(params) {
            $("#" + params).submit();
        }
    </script>
    @endsection