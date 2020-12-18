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
						<li class="nav-item {{ (Request::segment(1) == '#informasi') ? 'active' : '' }}">
							<a class="nav-link" href="/#informasi">Informasi</a>
						</li>
						<li class="nav-item {{ (Request::segment(1) == '#harga') ? 'active' : '' }}">
							<a class="nav-link" href="/#harga">Harga</a>
						</li>
						<li class="nav-item {{ (Request::segment(1) == '#kompeten') ? 'active' : '' }}">
							<a class="nav-link" href="/#kompeten">Data Kompeten</a>
						</li>
						<li class="nav-item {{ (Request::segment(1) ==  'masuk') ? 'active' : '' }}">
							<a class="nav-link " href="/masuk">Masuk</a>
						</li>
						<li class="nav-item">
							<a href="/daftar" id="tombolDaftar" class="nav-link btn btn-light warna-utama w-100">Daftar</a>
						</li>
						
					</ul>
				</div>
			</div>
		</nav>