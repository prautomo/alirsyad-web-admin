@extends("app/layout")

@section('content')
<div class="spacer"> </div>
<div class="container">
    <div id="products-container" 
    search_nama_produk ="{{request()->search_nama_produk}}"
    brand_id ="{{request()->brand_id}}"
    
     subcategory="{{$sub_categori_id}}"></div>
</div>
<div class="spacer"> </div>

@endsection