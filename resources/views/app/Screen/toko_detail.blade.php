@extends("app/layout")

@section('content')
<div class="spacer"> </div>
<div class="container " style="margin-top:100px">
    <div id="products-container-toko" toko_detail="{{json_encode($toko_detail)}}" search_nama_produk="{{request()->search_nama_produk}}" brand_id="{{request()->brand_id}}" subcategory="{{$sub_categori_id}}">


        <p>Sedang Memuat</p>
    </div>
</div>

</div>
<div class="spacer"> </div>

@endsection