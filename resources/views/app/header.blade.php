<header>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #fff;">
        <div class="container">
            <a class="navbar-brand" href="/"><img src="/images/logo.png" width="150px" class="img-fluid"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <div class="navbar-nav d-flex justify-content-center align-items-lg-center" style="width:100%">
                    <div class="lg-4 md-3 d-flex  d-flex flex-column">

                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="/images/kategori.png" class="img-fluid"> Kategori Materi
                        </a>
                        <div class="dropdown-menu dropdown-header-container mb-2" style="border-bottom:2px red solid" aria-labelledby="navbarDropdown">
                            <div class="container align-content-start d-flex flex-column" id="header_cateogory">

                            </div>
                        </div>
                    </div>


                    <!-- <div class="lg-8 md-7 d-flex ">
                        <form action="/materi" style="margin-bottom: 0px;">
                            <div class="input-group  ">
                                <input type="text" name="search_nama_produk" value="{{request()->search_nama_produk}}" class="form-control" placeholder="Cari Materi" aria-describedby="basic-addon1">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-danger" id="basic-addon1"><i style="color:#fff;" class="fa fa-search  pt-1"></i></button>
                                </div>
                            </div>
                        </form>
                    </div> -->

                </div>
                <div class=" navbar-nav justify-content-end" style="
    width: 400px;
    text-align: end;
">
                    @guest

                    <div class="d-flex  flex-column nav-item sm-te">
                        <a class="nav-link text-center" href="/login"><i class="fa fa-user"></i>&nbsp; <span>
                                Masuk</span></a>
                    </div>
                    @endguest
                    @auth



                    <li class="nav-item dropdown ">
                        <div id="navbarDropdown" class="nav-link  " href="#" role="button" data-toggle="dropdown" aria-haspopup="true">
                            <div class="d-flex  flex-row " style=" align-items: center;">
                                <i class="fa fa-user"></i>
                                <a>
                                    &nbsp;
                                    {{Auth::user()->name}}
                                </a>
                            </div>
                        </div>




                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item" href="/profile">
                                <i class="fa fa-user"></i>&nbsp; <span>
                                    Profile</span>
                            </a>


                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out" aria-hidden="true"></i> {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endauth

                    <div id="example">
                        </div>
                    
                </div>
            </div>
        </div>
    </nav>
</header>