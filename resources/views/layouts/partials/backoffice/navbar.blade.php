<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="{{ asset('images/logo.png') }}" class="navbar-brand-img" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">MAIN MENU</span>
          </h6>
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link{{ request()->is('home') ? ' active' : '' }}" href="{{ route('backoffice::dashboard') }}">
                <i class="ni ni-tv-2 text-red"></i>
                <span class="nav-link-text">Home</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link{{ request()->is('backoffice/tingkats*', 'backoffice/kelas*', 'backoffice/mata_pelajarans*', 'backoffice/promos*') ? ' active' : ' collapsed' }}" href="#navbar-master" data-toggle="collapse" role="button" aria-expanded="{{ request()->is('backoffice/tingkats*', 'backoffice/kelas*', 'backoffice/mata_pelajarans*') ? 'true' : 'false' }}" aria-controls="navbar-master">
                <i class="ni ni-ungroup text-red"></i>
                <span class="nav-link-text">Master</span>
              </a>
              <div class="collapse{{ request()->is('backoffice/tingkats*', 'backoffice/kelas*', 'backoffice/mata_pelajarans*', 'backoffice/promos*') ? ' show' : '' }}" id="navbar-master" style="">
                <ul class="nav nav-sm flex-column">
                  @can('tingkat-list')
                  <li class="nav-item">
                    <a href="{{ route('backoffice::tingkats.index') }}" class="nav-link">
                      <span class="sidenav-normal"> Tingkat </span>
                    </a>
                  </li>
                  @endcan
                  
                  @can('kelas-list')
                  <li class="nav-item">
                    <a href="{{ route('backoffice::kelas.index') }}" class="nav-link">
                      <span class="sidenav-normal"> Kelas </span>
                    </a>
                  </li>
                  @endcan

                  @can('mata_pelajaran-list')
                  <li class="nav-item">
                    <a href="{{ route('backoffice::mata_pelajarans.index') }}" class="nav-link">
                      <span class="sidenav-normal"> Mata Pelajaran </span>
                    </a>
                  </li>
                  @endcan

                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link{{ request()->is('backoffice/simulasis*', 'backoffice/videos*', 'backoffice/moduls*', 'backoffice/story-paths*') ? ' active' : ' collapsed' }}" href="#navbar-konten" data-toggle="collapse" role="button" aria-expanded="{{ request()->is('backoffice/simulasis*', 'backoffice/videos*', 'backoffice/moduls*', 'backoffice/story-paths*') ? 'true' : 'false' }}" aria-controls="navbar-konten">
                <i class="ni ni-atom text-red"></i>
                <span class="nav-link-text">Kelola Konten</span>
              </a>
              <div class="collapse{{ request()->is('backoffice/simulasis*', 'backoffice/videos*', 'backoffice/moduls*', 'backoffice/story-paths*') ? ' show' : '' }}" id="navbar-konten" style="">
                <ul class="nav nav-sm flex-column">

                  @can('modul-list')
                  <li class="nav-item">
                    <a href="{{ route('backoffice::moduls.index') }}" class="nav-link">
                      <span class="sidenav-normal"> Kelola Modul </span>
                    </a>
                  </li>
                  @endcan
                  
                  @can('video-list')
                  <li class="nav-item">
                    <a href="{{ route('backoffice::videos.index') }}" class="nav-link">
                      <span class="sidenav-normal"> Kelola Video </span>
                    </a>
                  </li>
                  @endcan

                  @can('simulasi-list')
                  <li class="nav-item">
                    <a href="{{ route('backoffice::simulasis.index') }}" class="nav-link">
                      <span class="sidenav-normal"> Kelola Simulasi </span>
                    </a>
                  </li>
                  @endcan

                  @can('story-path-list')
                  <li class="nav-item">
                    <a href="{{ route('backoffice::story-paths.index') }}" class="nav-link">
                      <span class="sidenav-normal"> Kelola Story Path </span>
                    </a>
                  </li>
                  @endcan

                </ul>
              </div>
            </li>

            @canany(['user-list', 'external-user-list'])
            <li class="nav-item">
              <a class="nav-link{{ request()->is('backoffice/users*', 'backoffice/external-users*') ? ' active' : ' collapsed' }}" href="#navbar-exus" data-toggle="collapse" role="button" aria-expanded="{{ request()->is('backoffice/users*', 'backoffice/external-users*') ? 'true' : 'false' }}" aria-controls="navbar-exus">
                <i class="ni ni-circle-08 text-red"></i>
                <span class="nav-link-text">Pengguna</span>
              </a>
              <div class="collapse{{ request()->is('backoffice/users*', 'backoffice/external-users*') ? ' show' : '' }}" id="navbar-exus" style="">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="{{ route('backoffice::users.index', ['role'=>'Superadmin']) }}" class="nav-link">
                      <span class="sidenav-normal"> Superadmin </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('backoffice::users.index', ['role'=>'Guru']) }}" class="nav-link">
                      <span class="sidenav-normal"> Guru Uploader </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('backoffice::external-users.index', ['role'=>'SISWA']) }}" class="nav-link">
                      <span class="sidenav-normal"> Siswa </span>
                    </a>
                  </li>
                  <!-- <li class="nav-item">
                    <a href="{{ route('backoffice::external-users.index', ['role'=>'JASA']) }}" class="nav-link">
                      <span class="sidenav-normal"> Services </span>
                    </a>
                  </li> -->
                </ul>
              </div>
            </li>
            @endcanany

            @can('role-list')
            <li class="nav-item">
              <a class="nav-link{{ request()->is('roles*') ? ' active' : '' }}" href="{{ route('backoffice::roles.index') }}">
                <i class="ni ni-tag text-red"></i>
                <span class="nav-link-text">Kelola Role</span>
              </a>
            </li>
            @endcan
    
            <!-- <li class="nav-item">
              <a class="nav-link{{ request()->is('backoffice/mitra*', 'backoffice/reports*') ? ' active' : ' collapsed' }}" href="#navbar-report" data-toggle="collapse" role="button" aria-expanded="{{ request()->is('backoffice/mitra*', 'backoffice/reports*') ? 'true' : 'false' }}" aria-controls="navbar-report">
                <i class="ni ni-ungroup text-red"></i>
                <span class="nav-link-text">Reports</span>
              </a>
              <div class="collapse{{ request()->is('backoffice/mitra*', 'backoffice/reports*') ? ' show' : '' }}" id="navbar-report" style="">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="../../pages/examples.html" class="nav-link">
                      <span class="sidenav-normal"> Transaction </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../../pages/examples.html" class="nav-link">
                      <span class="sidenav-normal"> Customer </span>
                    </a>
                  </li>
                </ul>
              </div>
            </li> -->

            <li class="nav-item">
                <a class="nav-link" href="{{ route('backoffice-logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();"
                >
                  <i class="ni ni-button-power text-red"></i>
                  <span class="nav-link-text">{{ __('Logout') }}</span>
                </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
</nav>
