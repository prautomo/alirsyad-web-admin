<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <!-- <img src="{{ asset('images/logo.png') }}" class="navbar-brand-img" alt="..."> -->
          {{ config('app.name', 'Digital Interactive Book') }}
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
         
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link{{ request()->is('guru') ? ' active' : '' }}" href="{{ route('guru::dashboard') }}">
                <i class="ni ni-tv-2 text-dark-green"></i>
                <span class="nav-link-text">Home</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link{{ request()->is('home') ? ' active' : '' }}" href="{{ route('guru::dashboard') }}">
                <i class="ni ni-single-copy-04 text-dark-green"></i>
                <span class="nav-link-text">Kelas Saya</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link{{ request()->is('guru/progress') ? ' active' : '' }}" href="{{ route('guru::progress.siswa') }}">
                <i class="ni ni-bullet-list-67 text-dark-green"></i>
                <span class="nav-link-text">Progress Siswa</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link{{ request()->is('home') ? ' active' : '' }}" href="{{ route('guru::akun-saya') }}">
                <i class="ni ni-single-02 text-dark-green"></i>
                <span class="nav-link-text">Akun Saya</span>
              </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('guru-logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();"
                >
                  <i class="ni ni-button-power text-dark-green"></i>
                  <span class="nav-link-text">{{ __('Logout') }}</span>
                </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
</nav>