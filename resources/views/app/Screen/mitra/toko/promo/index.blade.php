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
                        <a href="/toko/promo/create" class="btn btn-primary">Tambah</a>
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
                                            <a href="/toko/promo/{{$item->id}}/edit" class="btn btn-primary">Edit</a>
                                            <a class="btn btn-danger " onclick="event.preventDefault();
                                            deleteItem('{{$item->id}}');">Delete</a>
                                            <form method="post" action="/toko/promo/{{$item->id}}/delete" id="{{$item->id}}">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center">
                                        <div style=" width: 100px">

                                            <img src="{{$item->cover_image}}" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                                        </div>
                                        <div class="ml-2 d-flex flex-column">
                                            <span><b>Deskripsi :</b>{{$item->description}}</span>
                                            <div class="d-flex ">
                                                <div class=" d-flex flex-column">
                                                    <span><b>Kode : </b>{{$item->code}}</span>
                                                    <span><b>Tanggal Mulai : </b>{{$item->start_date}}</span>
                                                    <span><b>Tanggal Selesai : </b>{{$item->end_date}}</span>
                                                    <span><b>Diskon : </b>{{$item->potongan_nominal ? $item->potongan_nominal : $item->potongan_persen . "%"}}</span>
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