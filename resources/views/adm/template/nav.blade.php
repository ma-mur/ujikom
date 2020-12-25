		<nav class="navbar navbar-expand-lg navbar-ujikomp sticky-top shadow-sm">
			<div class="container-fluid">
				<a href="/" class="navbar-brand">
					<img src="{{ asset('images/logo.png')}}" class="d-inline" style="width: 200px" alt="logo">
				</a>
				<button class="navbar-toggler mx-auto" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
					<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
						<li class="nav-item {{ (Request::segment(2) == 'peserta') ? 'active' : '' }}">
							<a class="nav-link" href="/adm/peserta">Data Peserta</a>
						</li>
						<li class="nav-item  {{ (Request::segment(2) == 'hasil') ? 'active' : '' }}">
							<a class="nav-link" href="/adm/hasil">Pengajuan</a>
						</li>
						<li class="nav-item  {{ (Request::segment(2) == 'pembayaran') ? 'active' : '' }}">
							<a class="nav-link" href="/adm/pembayaran/belum">Pembayaran</a>
						</li>
						
						<li class="nav-item dropdown {{ (Request::segment(2) == 'skema' || Request::segment(2) == 'jadwal') ? 'active' : '' }}">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Kompetensi
							</a>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
								<a class="dropdown-item {{ (Request::segment(2) == 'skema') ? 'aktif' : '' }}" href="/adm/skema">Skema</a>
								<a class="dropdown-item {{ (Request::segment(2) == 'jadwal') ? 'aktif' : '' }}" href="/adm/jadwal">Jadwal</a>
								<a class="dropdown-item {{ (Request::segment(2) == 'asesor') ? 'aktif' : '' }}" href="/adm/asesor">Asesor</a>
							</div>
						</li>
						<li class="nav-item {{ (Request::segment(2) == 'informasi') ? 'active' : '' }}">
							<a class="nav-link" href="/adm/informasi">Informasi</a>
						</li>
						<li class="nav-item {{ (Request::segment(2) == 'laporan') ? 'active' : '' }}">
							<a class="nav-link" href="/adm/laporan">Laporan</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								{{ Auth::guard('admin')->user()->name }}
							</a>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
								<a class="dropdown-item" href="/adm/admin">Admin</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="/logout">Logout</a>
							</div>
						</li>
					</ul>
					<!--   <form class="form-inline my-2 my-lg-0">
																				<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
																				<button class="btn btn-cari my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
					</form> -->
				</div>
			</div>
		</nav>