<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Ilham Noorfaqih, Ferdhika Yudhira">
  <!--Load Stylesheets-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel='stylesheet' href="{{ asset('css/bootstrap-grid.css') }}" />
  <link rel='stylesheet' href="{{ asset('css/bootstrap-grid.min.css') }}" />
  <link rel='stylesheet' href="{{ asset('css/bootstrap.css') }}" />
  <link rel='stylesheet' href="{{ asset('css/bootstrap.min.css') }}" />
  <link rel='stylesheet' href="{{ asset('css/bootstrap-reboot.css') }}" />
  <link rel='stylesheet' href="{{ asset('css/bootstrap-reboot.min.css') }}" />
  <link rel='stylesheet' href="{{ asset('css/fly.min.css') }}" />
  <link rel='stylesheet' href="{{ asset('css/main.css') }}" />
  <!--End Stylesheets-->
  <link rel="icon" href="{{ asset('images/logo.png') }}" sizes="32x32" type="image/png">
  <title>
    Digi | Bangun Lebih Mudah
  </title>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #fff;">
      <a class="navbar-brand" href="index.html"><img src="images/logo.png" width="150px" class="img-fluid"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="images/kategori.png" class="img-fluid"> Kategori Produk
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <!--a class="dropdown-item" href="#">Action</a>
            <div class="dropdown-divider"></div-->
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
          <form class="form-inline">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Cari Produk atau Jasa" aria-describedby="basic-addon1">
              <div class="input-group-prepend">
                <span class="btn btn-danger" id="basic-addon1"><i style="color:#fff;" class="fa fa-search"></i></span>
              </div>
            </div>
          </form>
        </ul>
        <ul class="navbar-nav">
          <div class="row" style="text-align:center;">
            <div class="col col-md-5">
              <li class="nav-item sm-te">
                <a class="nav-link" href="login.html"><i class="fa fa-user"></i> Login</a>
              </li>
            </div>
          </div>
          <div class="row" style="text-align:center;">
            <div class="col col-md-5">
              <li class="nav-item sm-te">
                <a class="nav-link" href="register.html"><i class="fa fa-book"></i> Daftar</a>
              </li>
            </div>
          </div>
        </ul>
      </div>
    </nav>
  </header>
  <div class="spacer"> </div>
  <!--Banner-->

  <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="img-fluid d-block w-100" src="images/slide1.png" alt="First slide">
        <div class="carousel-caption d-none d-md-block">
          <h5>Kini Lebih Mudah Bangun Apapun</h5>
          <p>Penasaran gimana gampangnya bangun bersama DigiBook?</p>
          <p><button class="btn btn-danger btn-lg">Pelajari Selengkapnya</button></p>
        </div>
      </div>
    </div>
  </div>

  <div class="target floatcart">
    <a class="" href="cart.html"><span class="badge badge-pill badge-success" id="theCount" style="position: absolute; margin-left:-25px; margin-top:-20px; font-size:12pt;"></span><i class="fa fa-shopping-cart"></i> Cart</a>
  </div>
  <!--End Banner-->
  <div class="spacer"> </div>

  <!--Container-->
  <div class="container-fluid">
    <div class="row justify-content-lg-center align-items-center">
      <div class="col" style="text-align: center;">
        <h1>Jasa DigiBook</h1>
        <p style="font-size:small;color:#8d8d8d;">Layanan Jasa Powerful</p>
        <img src="images/border.png" class="img-fluid">
      </div>
    </div>
  </div>
  <!--Jasa-->
  <div class="spacer"></div>
  <div class="container-fluid row justify-content-sm-center">
    <p><img src="images/jasa.png" class="img-fluid" style="margin-left: 10px;"></p>
  </div>
  <p style="text-align: center;"><a href="jasa.html"><button class="btn btn-lg btn-danger">PESAN JASA</button></a></p>
  </div>
  <!--End of Jasa-->

  <div class="spacer"></div>

  <!--Mitra-->
  <div class="container-fluid">
    <div class="row justify-content-lg-center align-items-center">
      <div class="col" style="text-align: center;">
        <h1>Mitra Terdekat</h1>
        <p style="font-size:small;color:#8d8d8d;">Mitra sekitar Anda</p>
        <img src="images/border.png" class="img-fluid">
      </div>
    </div>
  </div>
  <div class="spacer"></div>
  <div class="container-fluid row justify-content-sm-center">
    <div class="card-group col-md-8">
      <div class="card " style="margin-left: 20px;">
        <img class="card-img-top" src="images/mitra.png" alt="Card image cap">
        <div class="card-body">
          <h4 class="card-title">TB. Hidup Makmur</h4>
          <p class="card-text">2.5 KM</p>
          <p class="card-text"><small class="text-muted"><i class="fa fa-map-marker"> </i> Kec. Ngamprah</small></p>
          <p style="text-align:center;"><button class="btn btn-danger btn-md" style="width:100%;">Lihat Toko</button></p>
        </div>
      </div>
      <div class="card" style="margin-left:20px;">
        <img class="card-img-top" src="images/mitra.png" alt="Card image cap">
        <div class="card-body">
          <h4 class="card-title">TB. Hidup Makmur</h4>
          <p class="card-text">2.5 KM</p>
          <p class="card-text"><small class="text-muted"><i class="fa fa-map-marker"> </i> Kec. Ngamprah</small></p>
          <p style="text-align:center;"><button class="btn btn-danger btn-md" style="width:100%;">Lihat Toko</button></p>
        </div>
      </div>
      <div class="card" style="margin-left: 20px;">
        <img class="card-img-top" src="images/mitra.png" width="100px" alt="Card image cap">
        <div class="card-body">
          <h4 class="card-title">TB. Hidup Makmur</h4>
          <p class="card-text">2.5 KM</p>
          <p class="card-text"><small class="text-muted"><i class="fa fa-map-marker"> </i> Kec. Ngamprah</small></p>
          <p style="text-align:center;"><button class="btn btn-danger btn-md" style="width:100%;">Lihat Toko</button></p>
        </div>
      </div>
      <div class="card" style="margin-left: 20px;">
        <img class="card-img-top" src="images/mitra.png" width="100px" alt="Card image cap">
        <div class="card-body">
          <h4 class="card-title">TB. Hidup Makmur</h4>
          <p class="card-text">2.5 KM</p>
          <p class="card-text"><small class="text-muted"><i class="fa fa-map-marker"> </i> Kec. Ngamprah</small></p>
          <p style="text-align:center;"><button class="btn btn-danger btn-md" style="width:100%;">Lihat Toko</button></p>
        </div>
      </div>
    </div>
  </div>
  <!--End of Mitra-->
  <div class="spacer"></div>
  <div class="container-fluid">
    <div class="row justify-content-lg-center align-items-center">
      <div class="col" style="text-align: center;">
        <h1>Promo Mitra</h1>
        <p style="font-size:small;color:#8d8d8d;">Promo dari Mitra</p>
        <img src="images/border.png" class="img-fluid">
      </div>
    </div>
  </div>
  <div class="spacer"></div>
  <!--Promo Mitra-->
  <div class="container-fluid row justify-content-sm-center">
    <div class="card-group col-md-8">
      <div class="card " style="margin-left: 20px;">
        <img class="card-img-top" src="images/dulux.png" alt="Card image cap">
        <div class="card-body">
          <h4 class="card-title">Dulux Cat Tembok</h4>
          <p class="card-text"><small class="text-muted"><strike>Rp. 35.000</strike></small></p>
          <p class="card-text">Rp. 40.000</p>
          <p style="text-align:center;"><button class="btn btn-danger btn-md addMe btn_rocketPulse" style="width:100%;"> Beli</button></p>
        </div>
      </div>
      <div class="card " style="margin-left: 20px;">
        <img class="card-img-top" src="images/dulux.png" alt="Card image cap">
        <div class="card-body">
          <h4 class="card-title">Dulux Cat Tembok</h4>
          <p class="card-text"><small class="text-muted"><strike>Rp. 35.000</strike></small></p>
          <p class="card-text">Rp. 40.000</p>
          <p style="text-align:center;"><button class="btn btn-danger btn-md addMe btn_rocketPulse" style="width:100%;"> Beli</button></p>
        </div>
      </div>
      <div class="card " style="margin-left: 20px;">
        <img class="card-img-top" src="images/dulux.png" alt="Card image cap">
        <div class="card-body">
          <h4 class="card-title">Dulux Cat Tembok</h4>
          <p class="card-text"><small class="text-muted"><strike>Rp. 35.000</strike></small></p>
          <p class="card-text">Rp. 40.000</p>
          <p style="text-align:center;"><button class="btn btn-danger btn-md addMe btn_rocketPulse" style="width:100%;"> Beli</button></p>
        </div>
      </div>
      <div class="card " style="margin-left: 20px;">
        <img class="card-img-top" src="images/dulux.png" alt="Card image cap">
        <div class="card-body">
          <h4 class="card-title">Dulux Cat Tembok</h4>
          <p class="card-text"><small class="text-muted"><strike>Rp. 35.000</strike></small></p>
          <p class="card-text">Rp. 40.000</p>
          <p style="text-align:center;"><button class="btn btn-danger btn-md addMe btn_rocketPulse" style="width:100%;"> Beli</button></p>
        </div>
      </div>
    </div>
  </div>
  <!--End of Promo Mitra-->
  <div class="spacer"></div>
  <div class="container-fluid">
    <div class="row justify-content-lg-center align-items-center">
      <div class="col" style="text-align: center;">
        <h1>Brand</h1>
        <p style="font-size:small;color:#8d8d8d;">Official Brand di DigiBook</p>
        <img src="images/border.png" class="img-fluid">
      </div>
    </div>
  </div>
  <div class="spacer"></div>
  <!--Brand-->
  <div class="row justify-content-lg-center">
    <div class="col col-lg-4">
      <img src="images/brands.png" class="img-fluid">
    </div>
    <div class="col-lg-6">
      <div class="row">
        <div class="col-md-4">
          <a href=""><img src="images/brand1.png" class="img-fluid"></a>
          <img src="images/brand2.png" class="img-fluid">
        </div>
        <div class="col-md-4">
          <img src="images/brand3.png" class="img-fluid">
          <img src="images/brand4.png" class="img-fluid">
        </div>
        <div class="col-md-4">
          <img src="images/brand5.png" class="img-fluid">
          <img src="images/brand6.png" class="img-fluid">
        </div>
      </div>
    </div>
  </div>
  <!--End of Brand-->
  <div class="spacer"></div>
  <div class="container-fluid">
    <div class="row justify-content-lg-center align-items-center">
      <div class="col" style="text-align: center;">
        <h1>Artikel</h1>
        <p style="font-size:small;color:#8d8d8d;">Artikel dari DigiBook</p>
        <img src="images/border.png" class="img-fluid">
      </div>
    </div>
  </div>
  <div class="spacer"></div>
  <!--Artikel-->
  <div class="row justify-content-lg-center">
    <div class="col col-lg-4">
      <a href="" class="link-artikel"><img src="images/artikel1.png" class="img-fluid">
        <h3>Desain rumah minimalis kini sangat digemari!</h3>
        <p><small><i class="fa fa-calendar"></i> 28-11-2020 </small></p>
      </a>
    </div>
    <div class="col-lg-6">
      <div class="row">
        <div class="col-md-4">
          <a href="" class="link-artikel"><img src="images/artikel2.png" class="img-fluid">
            <h4>Awas Salah pilih kontraktor!</h4>
            <p><small><i class="fa fa-calendar"></i> 28-11-2020 </small></p>
          </a>
          <a href="" class="link-artikel"><img src="images/artikel2.png" class="img-fluid">
            <h4>Awas Salah pilih kontraktor!</h4>
            <p><small><i class="fa fa-calendar"></i> 28-11-2020 </small></p>
          </a>
        </div>
        <div class="col-md-4">
          <a href="" class="link-artikel"><img src="images/artikel2.png" class="img-fluid">
            <h4>Awas Salah pilih kontraktor!</h4>
            <p><small><i class="fa fa-calendar"></i> 28-11-2020 </small></p>
          </a>
          <a href="" class="link-artikel"><img src="images/artikel2.png" class="img-fluid">
            <h4>Awas Salah pilih kontraktor!</h4>
            <p><small><i class="fa fa-calendar"></i> 28-11-2020 </small></p>
          </a>
        </div>
        <div class="col-md-4">
          <a href="" class="link-artikel"><img src="images/artikel2.png" class="img-fluid">
            <h4>Awas Salah pilih kontraktor!</h4>
            <p><small><i class="fa fa-calendar"></i> 28-11-2020 </small></p>
          </a>
          <a href="" class="link-artikel"><img src="images/artikel2.png" class="img-fluid">
            <h4>Awas Salah pilih kontraktor!</h4>
            <p><small><i class="fa fa-calendar"></i> 28-11-2020 </small></p>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!--End of Artikel-->

  <!--End of Container-->
  <div class="spacer"> </div>
  <!--footer-->
  <div class="row justify-content-lg-center footercontent">
    <div class="col col-md-4">
      <img src="images/berhmanwhite.png" width="200px" class="img-fluid">
      <p><b>Berkah Mandiri, melayani dengan hati</b></p>
      <p>Jln. Hj. Gofur. No. 00 Desa Tanimulya, Kabupaten Bandung Barat, Jawa Barat 40511</p>
    </div>
    <div class="col col-md-3">
      <h5>Layanan Konsumen</h5>
      <ul type="none" class="nav navbar-nav ml-auto">
        <li><a href="#">Cara Belanja</a></li>
        <li><a href="#">Pembayaran</a></li>
        <li><a href="#">FAQ</a></li>
      </ul>
    </div>
    <div class="col col-md-3">
      <h5>Hubungi Kami</h5>
      <ul type="none" class="nav navbar-nav ml-auto">
        <li><a href="mailto:digibook@gmail.com"><i class="fa fa-envelope"></i> digibook@gmail.com</a></li>
        <li><a href="tel:000"><i class="fa fa-phone"></i> 021-0-0-0</a></li>
        <li>Senin - Minggu (09.00 - 17.00)</li>
      </ul>
      <br>
      <div class="row">
        <div class="col ">
          <a href=""><i class="fa fa-facebook"> &nbsp;</i></a>
          <a href=""><i class="fa fa-twitter"> &nbsp;</i></a>
          <a href=""><i class="fa fa-instagram"> &nbsp;</i></a>
        </div>
      </div>
    </div>
    <div class="row justify-content-lg-center">
      <div class="col">
        <img src="images/line_white.png" class="img-fluid">
      </div>
    </div>
  </div>
  <div class="row footerend justify-content-lg-center">
    <div class="col col-sm-6">
      <p>&copy; 2020 DigiBook. All Right Reserverd</p>
    </div>
    <div class="col col-sm-2">
      <p><a href="">Privacy and Policy</a></p>
    </div>
    <div class="col col-sm-2">
      <p><a href="">Term of Use</a></p>
    </div>

    <!--end footer-->
</body>

</html>
<!--Load Javascript-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/fly.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script>
  $('.carousel .carousel-item').each(function() {
    var next = $(this).next();
    if (!next.length) {
      next = $(this).siblings(':first');
    }
    next.children(':first-child').clone().appendTo($(this));

    for (var i = 0; i < 4; i++) {
      next = next.next();
      if (!next.length) {
        next = $(this).siblings(':first');
      }

      next.children(':first-child').clone().appendTo($(this));
    }
  });
</script>

<script>
  var counter = 0;

  $(document).ready(function() {
    $("#theCount").text(window.sessionStorage.getItem("cart"));
    $(".addMe").click(function() {
      counter++;
      window.sessionStorage.setItem("cart", counter);
      $("#theCount").text(window.sessionStorage.getItem("cart"));
    });
  });
</script>

<script>
  $(document).ready(function() {
    //Default 
    function normalstate(norm) {
      $(norm).css({
        opacity: "1"
      });
    }
    //rocketPulse Effect Animation 
    $('.btn_rocketPulse').on('click', function() {
      rocketcss(this, '.target', 'rocketPulse');
      $('.target').addClass('targetPulse');
      setTimeout(function() {
        normalstate('.rocket');
        $('.target').removeClass('targetPulse');
      }, 2300);
    });
  });
</script>