<div class="col-lg-3">


    @if(Auth::user()->role == "CUSTOMER")

    <div class="d-flex flex-column mb-2">
        <h3 class="mb-4"><b>Akun</b></h3>
        <div class="d-flex flex-column mb-4 ml-1 app-menu">
            <a href="/profile"><i class="fa fa-user-circle" aria-hidden="true"></i> Profile</a>
            <a href="/profile/edit"><i class="fa fa-user-circle" aria-hidden="true"></i> Ubah Profile</a>
            <a href="/profile/ubah_password"><i class="fa fa-key" aria-hidden="true"></i> Ubah Password</a>
        </div>
    </div>

    <div class="d-flex flex-column mb-2">
        <h3 class="mb-4"><b>Pesanan Barang</b></h3>
        <div class="d-flex flex-column mb-4 ml-1 app-menu">
            <a href="/customer/transaction/new"><i class="fa fa-database" aria-hidden="true"></i> Baru</a>
            <a href="/customer/transaction/process"><i class="fa fa-database" aria-hidden="true"></i> Sedang Proses</a>
            <a href="/customer/transaction/finish"><i class="fa fa-database" aria-hidden="true"></i> Selesai</a>


            <h5 class="mb-2 mt-2">
                Pesanan Jasa</h5>
            <a href="/customer/jasa/transaction/new"><i class="fa fa-database" aria-hidden="true"></i> Baru</a>
            <a href="/customer/jasa/transaction/process"><i class="fa fa-database" aria-hidden="true"></i> Sedang Proses</a>
            <a href="/customer/jasa/transaction/finish"><i class="fa fa-database" aria-hidden="true"></i> Selesai</a>
        </div>
    </div>
    @elseif(Auth::user()->role == "MITRA")

    <div class="d-flex flex-column mb-2">
        <h3 class="mb-4"><b>Akun</b></h3>
        <div class="d-flex flex-column mb-4 ml-1 app-menu">
            <a href="/profile"><i class="fa fa-user-circle" aria-hidden="true"></i> Profile Toko </a>
            <a href="/profile/edit"><i class="fa fa-user-circle" aria-hidden="true"></i> Ubah Profile Toko</a>
            <a href="/profile/ubah_password"><i class="fa fa-key" aria-hidden="true"></i> Ubah Password </a>

            <h5 class="mb-2 mt-2">
                Toko</h5>
            <a href="/toko/update"><i class="fa fa-database" aria-hidden="true"></i> Setting Toko </a>
            <a href="/toko/product"><i class="fa fa-database" aria-hidden="true"></i> Product </a>
            <a href="/toko/promo"><i class="fa fa-database" aria-hidden="true"></i> Promo </a>

            <h5 class="mb-2 mt-2">
                Pesanan</h5>
            <a href="/toko/transaction/new"><i class="fa fa-database" aria-hidden="true"></i> Baru</a>
            <a href="/toko/transaction/process"><i class="fa fa-database" aria-hidden="true"></i> Sedang Proses</a>
            <a href="/toko/transaction/finish"><i class="fa fa-database" aria-hidden="true"></i> Selesai</a>
        </div>
    </div>

    <div class="d-flex flex-column mb-2">
        <h3 class="mb-4"><b>Jasa</b></h3>
        <div class="d-flex flex-column mb-4 ml-1 app-menu">
            <a href="/jasa/update"><i class="fa fa-database" aria-hidden="true"></i> Setting Jasa </a>
            <h5 class="mb-2 mt-2">
                Pesanan</h5>
            <a href="/jasa/transaction/new"><i class="fa fa-database" aria-hidden="true"></i> Baru</a>
            <a href="/jasa/transaction/process"><i class="fa fa-database" aria-hidden="true"></i> Sedang Proses</a>
            <a href="/jasa/transaction/finish"><i class="fa fa-database" aria-hidden="true"></i> Selesai</a>
        </div>

    </div>

    @endif
</div>