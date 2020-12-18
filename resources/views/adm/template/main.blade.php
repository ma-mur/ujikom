<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<title>{{ str_replace('_', ' ', config('app.name')) }}</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/stmik-sumedang.png') }}" />
		<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/all.css') }}">
		<link rel="stylesheet" href="{{ asset('css/style.css') }}">
		
	</head>
	<body>
		<!-- awal nav -->
			@include('adm.template.nav')
		<!-- akhir nav -->
		
		<!-- awal content -->
		<main class="mb-5">
			@yield('konten')
		</main>
		<!-- akhir content -->
		
		<!-- awal footer -->
		<footer class="mt-3 bg-utama footer-fixed">
			<div class="container-fluid pt-4">
				<div class="row ">
					<div class="col-md-3 text-center">
						<a href="/"><img src="{{ asset('images/logo.png') }}" class="d-inline" style="width: 200px" alt="logo"></a>
						<p class="mt-2">STMIK Sumedang menjadi Sekolah Tinggi yang unggul dalam bidang manajemen informatika dan komputer di Jawa Barat pada tahun 2022</p>
					</div>
					<div class="col-md-3">
						<h3 class="text-center">Quick Links</h3>
						<ul style="list-style: none">
							<li><a href="#" class="teks-link"><i class="fas fa-link"></i> STMIK Sumedang</a></li>
							<li><a href="#" class="teks-link"><i class="fas fa-link"></i> Sistem Informasi</a></li>
							<li><a href="#" class="teks-link"><i class="fas fa-link"></i> E-Journal</a></li>
							<li><a href="#" class="teks-link"><i class="fas fa-link"></i> Perpustakaan</a></li>
							<li><a href="#" class="teks-link"><i class="fas fa-link"></i> SPMI STMIK Sumedang</a></li>
							<li><a href="#" class="teks-link"><i class="fas fa-link"></i> PMB STMIK Sumedang</a></li>
							<li><a href="#" class="teks-link"><i class="fas fa-link"></i> Literasi Digital</a></li>
						</ul>
					</div>
					<div class="col-md-3 text-center mb-3">
						<h3>Follow Us</h3>
						<a href="#" class="teks-link mx-1"><i class="fab fa-facebook fa-2x"></i></a>
						<a href="#" class="teks-link mx-1"><i class="fab fa-twitter fa-2x"></i></a>
					</div>
					<div class="col-md-3">
						<h3 class=" text-center">Contact</h3>
						<p><i class="fas fa-map"></i> Jl.Angkrek Situ No.19 Sumedang</p>
						<p><i class="fas fa-phone"></i> Phone: (0261) 207395</p>
						<a href="#" class="teks-link"><p><i class="fas fa-envelope"></i> E-mail: info@stmik-sumedang.ac.id</p></a>
					</div>
				</div>
			</div>
			<small class="d-block py-3 text-center copyright">Copyright &copy; 2020 Uji Kompetensi - STMIK Sumedang</small>
		</footer>
		<!-- akhir footer -->
		
		<!-- back to top -->
		<!-- <button onclick="topFunction()" id="to-top" title="Go to top"><i class="fas fa-angle-up fa-2x"></i></button> -->
		
		<!-- custom script -->
		{{-- <script src="{{ asset('js/app.js') }}"></script> --}}
		<script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
		<script src="{{ asset('js/popper.min.js') }}"></script>
		<script src="{{ asset('js/bootstrap.js') }}"></script>
		<script src="{{ asset('js/dataTables.min.js') }}"></script>
		<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
		<script src="{{ asset('js/Chart.bundle.min.js') }}"></script>
		<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

		@yield('script')
		
	</body>
</html>