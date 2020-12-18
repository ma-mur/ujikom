@extends('adm.template.main')

@section('konten')
			<!-- section 1 -->
			<div class="container">
				<h5 class="judul-section">Profile Peserta :</h5>
				<hr>
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8 mb-3">
						<div class="card shadow">
							<div class="card-header">
								<a href="/adm/peserta" class="btn btn-secondary"><i class="fas fa-angle-left"></i> Kembali</a>
							</div>
							<div class="card-body">
							@foreach($detail as $d)
								<div class="form-group row">
									<label for="nama" class="col-sm-4 teks">Foto :</label>
									<div class="col-sm-8 mt-0">
										<img src="/storage/foto/{{ $d->foto }}" class="img-thumbnail" style="width: 150px;">
									</div>
								</div>
								<div class="form-group row">
									<label for="nama" class="col-sm-4 teks">NIK :</label>
									<div class="col-sm-8 mt-0">
										<p>{{ $d->nik }}</p>
									</div>
								</div>
								<div class="form-group row">
									<label for="nama" class="col-sm-4 teks">Nama Lengkap :</label>
									<div class="col-sm-8 mt-0">
										<p>{{ $d->nama_lengkap }}</p>
									</div>
								</div>
								<div class="form-group row">
									<label for="nama" class="col-sm-4 teks">Institusi :</label>
									<div class="col-sm-8 mt-0">
										<p>{{ str_replace('_', ' ', $d->institusi) }}</p>
									</div>
								</div>
								<div class="form-group row">
									<label for="nama" class="col-sm-4 teks">Skema Kompetensi :</label>
									<div class="col-sm-8 mt-0">
										{{ $d->nama_kompetensi }}
									</div>
								</div>
								<div class="form-group row">
									<label for="nama" class="col-sm-4 teks">KTP :</label>
									<div class="col-sm-8 mt-0">
										<img src="/storage/ktp/{{ $d->ktp }}" class="img-thumbnail img-preview-foto" style="width: 100%;height: 220px;">
									</div>
								</div>
								<div class="form-group row">
									<label for="nama" class="col-sm-4 teks">E-mail :</label>
									<div class="col-sm-8 mt-0">
										<p>{{ $d->email }}</p>
									</div>
								</div>
								<div class="form-group row">
									<label for="nama" class="col-sm-4 teks">No Telp :</label>
									<div class="col-sm-8 mt-0">
										<p>{{ $d->no_telp }}</p>
									</div>
								</div>
								<div class="form-group row">
									<label for="nama" class="col-sm-4 teks">Tanggal Lahir:</label>
									<div class="col-sm-8 mt-0">
										<p>{{ $d->tanggal_lahir }}</p>
									</div>
								</div>
								<div class="form-group row">
									<label for="nama" class="col-sm-4 teks">Alamat :</label>
									<div class="col-sm-8 mt-0">
										<p>{{ $d->alamat }}</p>
									</div>
								</div>
								<div class="form-group row">
									<label for="nama" class="col-sm-4 teks">Tanggal Pendaftaran :</label>
									<div class="col-sm-8 mt-0">
										<p>{{ $d->tanggal_pendaftaran }}</p>
									</div>
								</div>
							@endforeach
							</div>
						</div>
					</div>
					<div class="col-md-2"></div>		
				</div>
			</div>
			<!-- section temp -->
@endsection