@extends('peserta.template.main')

@section('konten')
			<!-- section 1 -->
			<div class="container mt-3">
				<div class="row">
					<div class="col-md-8 mb-3">
						<div class="card shadow">
							<div class="card-header">
								Profile
							</div>
							<div class="card-body">
								<div class="form-group row">
									<label for="nama" class="col-sm-4 teks">Foto :</label>
									<div class="col-sm-8 mt-0">
										<img src="storage/foto/{{ $profile->foto }}" class="img-thumbnail" style="width: 150px;">
									</div>
								</div>
								<div class="form-group row">
									<label for="nama" class="col-sm-4 teks">NIK :</label>
									<div class="col-sm-8 mt-0">
										<p>{{ $profile->nik }}</p>
									</div>
								</div>
								<div class="form-group row">
									<label for="nama" class="col-sm-4 teks">Nama Lengkap :</label>
									<div class="col-sm-8 mt-0">
										<p>{{ $profile->nama_lengkap }}</p>
									</div>
								</div>
								<div class="form-group row">
									<label for="nama" class="col-sm-4 teks">Institusi :</label>
									<div class="col-sm-8 mt-0">
										<p>{{ str_replace('_', ' ', $profile->institusi) }}</p>
									</div>
								</div>
								<div class="form-group row">
									<label for="nama" class="col-sm-4 teks">Skema Kompetensi :</label>
									<div class="col-sm-8 mt-0">
										<ol>
										@foreach($skema as $s)
											<li>{{ $s->nama_kompetensi }} <span class="badge badge-primary">{{ $s->jumlah }}x</span></li>
										@endforeach
										</ol>
									</div>
								</div>
								<div class="form-group row">
									<label for="nama" class="col-sm-4 teks">KTP :</label>
									<div class="col-sm-8 mt-0">
										<img src="storage/ktp/{{ $profile->ktp }}" class="img-thumbnail img-preview-foto" style="width: 100%;height: 220px;">
									</div>
								</div>
								<div class="form-group row">
									<label for="nama" class="col-sm-4 teks">E-mail :</label>
									<div class="col-sm-8 mt-0">
										<p>{{ $profile->email }}</p>
									</div>
								</div>
								<div class="form-group row">
									<label for="nama" class="col-sm-4 teks">No Telp :</label>
									<div class="col-sm-8 mt-0">
										<p>{{ $profile->no_telp }}</p>
									</div>
								</div>
								<div class="form-group row">
									<label for="nama" class="col-sm-4 teks">Tanggal Lahir:</label>
									<div class="col-sm-8 mt-0">
										<p>{{ $profile->tanggal_lahir }}</p>
									</div>
								</div>
								<div class="form-group row">
									<label for="nama" class="col-sm-4 teks">Alamat :</label>
									<div class="col-sm-8 mt-0">
										<p>{{ $profile->alamat }}</p>
									</div>
								</div>
								<div class="form-group row">
									<label for="nama" class="col-sm-4 teks">Tanggal Pendaftaran :</label>
									<div class="col-sm-8 mt-0">
										<p>{{ $profile->tanggal_pendaftaran }}</p>
									</div>
								</div>

							</div>
						</div>
					</div>
					<div class="col-md-4 mb-3">
						<div class="card shadow">
							<div class="card-header">
								Ganti Password
							</div>
							<div class="card-body">
								<form action="/profile" method="post">
									@csrf
									@method('PUT')
									<input id="email" type="hidden" name="email" class="form-control" readonly value="{{ Auth::guard('peserta')->user()->email }}">
									<div class="form-group">
										<label for="pass-baru">Password Baru</label>
										<input id="pass-baru" type="password" name="password" class="form-control" required>
									</div>
									<div class="form-group">
										<label for="konfirmasi">Konfirmasi Password Baru</label>
										<input id="konfirmasi" type="password" name="password_confirmation" class="form-control" required>
									</div>
									@if (session('invalid'))										
										<p class="text-danger">{{ session('invalid') }}</p>
									@endif
									<div class="form-group">
										<button type="submit" class="btn btn-primary w-100">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- section temp -->
@endsection

@section('script')

	<script>
		@if(session('sukses'))
			Swal.fire(
				'Berhasil',
				'{{ session('sukses') }}',
				'success'
			);
		@else if (session('gagal'))
			
			Swal.fire(
				'Berhasil',
				'{{ session('gagal') }}',
				'success'
			);
		@endif
	</script>
@endsection