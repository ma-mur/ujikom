@extends('template.main')

@section('konten')
			<!-- section 1 -->
			<div class="container">
				<hr>
				<form action="/masuk" method="post">
				@csrf
				@method('POST')
					<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
					<div class="card mb-2 bg-utama">
						<div class="card-body h-100">
							<h3 class="judul-section-putih mb-4 text-left">Masuk ke akun Anda</h3>
							<hr style="background-color: #fff">
							@if (session('info'))
							<div class="alert alert-danger" role="alert">
								{{ session('info') }}
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							@endif
								<div class="row mb-3">
									<div class="col-md-6">
										<div class="form-group">
											<label for="email">Email</label>
											<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email Terdaftar" value="{{ old('email') }}">
											@error('email')
												<small class="text-light">{{ $message }}</small>
											@enderror
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="password">Password</label>
											<input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password default (NIK)">
											@error('password')
												<small class="text-light">{{ $message }}</small>
											@enderror
										</div>
									</div>
									
									<div class="col-md-12 mt-2">
										<div class="form-group">
											<button type="submit" class="mt-2 btn btn-light w-100">Masuk</button>
										</div>
									</div>
									{{-- <div class="col-md-4">
										<a href="#" class="teks-link">Lupa Password?</a>
									</div> --}}
									<div class="col-md-8">
										<p>Belum punya Akun? <a href="/daftar" class="teks-link">Daftar Disini!</a></p>
									</div>
								</div>
						</div>
					</div>
					</div>					
				</div>
				</form>
				<hr >
			</div>
			<!-- section temp -->
@endsection