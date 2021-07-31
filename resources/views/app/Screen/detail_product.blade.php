@extends("app/layout")

@section('content')
<div class="spacer"> </div>
<div class="container">
    <div id="products-detail" prod_id="{{request()->id}}"></div>
</div>
<div class="spacer"> </div>

@endsection