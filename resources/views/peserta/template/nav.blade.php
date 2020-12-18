		<nav class="navbar navbar-expand-lg navbar-ujikomp sticky-top shadow-sm">
			<div class="container-fluid">
				<a href="/" class="navbar-brand">
					<img src="{{asset('images/logo.png')}}" class="d-inline" style="width: 200px" alt="logo">
				</a>
				<button class="navbar-toggler mx-auto" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
					<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
						<li class="nav-item {{ (Request::segment(1) == 'home') ? 'active' : '' }}">
							<a class="nav-link" href="/home/belum">Home</a>
						</li>
						<li class="nav-item {{ (Request::segment(1) == 'pembayaran') ? 'active' : '' }}">
							<a class="nav-link" href="/pembayaran">Pembayaran</a>
						</li>
						<li class="nav-item {{ (Request::segment(1) == 'jadwal' ? 'active' : '	') }}">
							<a class="nav-link" href="/jadwal">Jadwal Pengujian</a>
						</li>
						<li class="nav-item {{ (Request::segment(1) == 'hasil' ? 'active' : '	') }}">
							<a class="nav-link" href="/hasil">Hasil Pengujian</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								{{ Auth::guard('peserta')->user()->nama_lengkap }}
							</a>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
								<a class="dropdown-item" href="/profile">Profile</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="/logout">Logout</a>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</nav>