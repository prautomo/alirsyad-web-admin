@extends("app/layout")

@section('content')
<div class="spacer"> </div>
<div class="container " style="margin-top:100px">
    <div class="row justify-content-lg-center">
        <div class="col col-lg-12 ">
            <div class="flex-column justify-content-center align-items-center d-flex">
                <img src="{{$article->cover_image}}" class="img-fluid " style="height:100%" alt="">
                <div class="row align-items-center d-flex justify-content-center mt-4">
                    <div class="col-lg-8 col-offset-2">


                        <h4>{{$article->title}}</h4>


                        <div class="d-flex justify-content-between w-100 pb-4 pt-4">
                            <span>
                                {{$article->author}}</span>
                            <span>
                                <i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;{{new \Carbon\Carbon($article->created_at)}}</span>
                        </div>

                        <p class="mt-3">
                            {{$article->content}}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!--End of Brand-->
        <div class="spacer" ></div>
        <div class="container-fluid" style="margin-top:100px">
            <div class="row justify-content-lg-center align-items-center">
                <div class="col" style="text-align: center;">
                    <h4>Artikel</h4>
                    <p style="font-size:small;color:#8d8d8d;">Artikel dari DigiBook</p>
                    <img src="/images/border.png" class="img-fluid">
                </div>
            </div>
        </div>
        <div class="spacer"></div>
        <!--Artikel-->
        <div class="container">

            <div class="row justify-content-lg-center">
                <div class="col-lg-12">
                    <div class="row">

                        @foreach ($articles as $index => $article)
                        <div class="col-md-3">
                            <a href="article/read/{{$article->slug}}" class="link-artikel"><img src="{{$article->cover_image}}" class="img-fluid">
                                <h4>{{$article->title}}</h4>
                                <p><small><i class="fa fa-calendar"></i> {{\Carbon\Carbon::parse($article->created_at)->format("D , d-M-Y")}} </small></p>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="spacer"> </div>

@endsection