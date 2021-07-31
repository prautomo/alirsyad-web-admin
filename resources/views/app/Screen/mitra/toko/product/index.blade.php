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



                    <div class="col-lg-12 text-right">
                        <a href="/toko/product/create" class="btn btn-primary">Tambah</a>
                    </div>
                    <div class="col-lg-12">

                        <div class="card-body pl-1 pr-1">
                            @foreach($paginated as $index => $item)
                            <!-- {{json_encode($item)}} -->

                            <div class="card text-left mb-2">
                                <div class="card-body">
                                    <div class="d-flex flex-row justify-content-between">

                                        <h4 class="card-title">{{$item->name}} </h4>
                                        <div>
                                            <a href="/toko/product/{{$item->sku_id}}/edit" class="btn btn-primary">Edit</a>
                                            <a class="btn btn-danger " onclick="event.preventDefault();
                                            deleteItem('{{$item->sku_id}}');">Delete</a>
                                            <form method="post" action="/toko/product/{{$item->sku_id}}/delete" id="{{$item->sku_id}}">
                                            @csrf
                                            </form>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center">
                                        <div style=" width: 100px">

                                            <img src="{{$item->cover ? $item->cover->image_url : ''}}" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                                        </div>
                                        <div class="ml-2 d-flex flex-column">
                                            <span class="m-0"><b>Sku: </b>{{$item->sku_id}}</span>
                                            <span><b>Deskripsi :</b>{{$item->description}}</span>
                                            <div class="d-flex ">
                                                <div class=" d-flex flex-column">
                                                    <span><b>Terjual : </b>{{$item->terjual}}</span>
                                                    <span><b>Tambahkan : </b>{{$item->created_at}}</span>

                                                </div>
                                                <div class="ml-2 d-flex flex-column">
                                                    <span><b>Spesifikasi :</b>{{$item->spesification}}</span>
                                                    <span><b>Keunggulan : </b>{{$item->keunggulan}}</span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="pt-2">

                                {{$paginated}}
                            </div>
                        </div>
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