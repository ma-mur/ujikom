@extends('adm.template.main')

@section('konten')
			<!-- section 1 -->
			<div class="container">
				<h5 class="judul-section">Form Edit Data Peserta :</h5>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<div class="card shadow">
							<div class="card-header">
								<a href="/adm/peserta" class="btn btn-secondary"><i class="fas fa-angle-left"></i> Kembali</a>
							</div>
							<div class="card-body">
								<form action="/adm/peserta/{{ $peserta->id }}" method="post" enctype="multipart/form-data">
									@csrf
									@method('put')
								{{-- 	<div class="card mb-2 shadow-sm">
										<div class="card-header bg-utama">Digunakan untuk login/masuk</div>
										<div class="card-body">
											
										</div>
									</div> --}}

									<div class="form-group row">
										<label for="email" class="col-sm-2 teks">Email</label>
										<div class="col-sm-5">
											<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $peserta->email }}">
										</div>
										<div class="col-sm-5">
											@error('email') 
												<small class="teks-danger">{{ $message }}</small>
											@enderror
										</div>
									</div>
									<div class="form-group row">
										<label for="password" class="col-sm-2 teks">password</label>
										<div class="col-sm-5">
											<input type="password" class="form-control " id="passwordnew" name="passwordnew" placeholder="kosongkan jika tidak diubah">
											
											<input type="hidden" class="form-control @error('password') is-invalid @enderror" id="passwordold" name="passwordold" value="{{ $peserta->password }}">
										</div>
										<div class="col-sm-5">
											@error('password') 
												<small class="teks-danger">{{ $message }}</small>
											@enderror
										</div>
									</div>
									<div class="form-group row">
										<label for="nik" class="col-sm-2 teks">NIK</label>
										<div class="col-sm-5">
											<input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ $peserta->nik }}">
										</div>
										<div class="col-sm-5">
											@error('nik') 
												<small class="teks-danger">{{ $message }}</small>
											@enderror
										</div>
									</div>
									<div class="form-group row">
										<label for="nama" class="col-sm-2 teks">Nama Lengkap</label>
										<div class="col-sm-5">
											<input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap" value="{{ $peserta->nama_lengkap }}">
										</div>
										<div class="col-sm-5">
											@error('nama_lengkap') 
												<small class="teks-danger">{{ $message }}</small>
											@enderror
										</div>
									</div>
									<div class="form-group row">
										<label for="institusi" class="col-sm-2 teks">Institusi</label>
										<div class="col-sm-5">
											<select name="institusi" id="institusi" class="form-control @error('institusi') is-invalid @enderror" onchange="Institusi()">
												<option selected value="{{ $peserta->institusi }}">{{ str_replace('_', ' ', $peserta->institusi) }}</option>
												<option disabled>-- Pilih --</option>
												<option value="STMIK Sumedang" >STMIK Sumedang</option>
												<option value="Umum">Umum</option>
												<option value="lain">Lainnya</option>
											</select>
											<input type="text" id="lainnya" name="lainnya" class="form-control mt-2" placeholder="ketikkan disini.." style="display: none">
										</div>
										<div class="col-sm-5">
											@error('institusi') 
												<small class="teks-danger">{{ $message }}</small>
											@enderror
										</div>
									</div>
									<div class="form-group row">
										<label for="kompetensi" class="col-sm-2 teks">Skema Kompetensi</label>
										<div class="col-sm-5">
											<select name="skema_kompetensi" id="kompetensi" class="form-control @error('skema_kompetensi') is-invalid @enderror">
												<option selected disabled>-- Pilih --</option>
												@foreach($skema as $s)
													@if ($peserta->id_kompetensi  == $s->id)
														<option value="{{ $s->id }}" selected>{{ $s->nama_kompetensi }}</option>
													@else
														<option value="{{ $s->id }}">{{ $s->nama_kompetensi }}</option>
													@endif
												@endforeach
											</select>
										</div>
										<div class="col-sm-5">
											@error('skema_kompetensi') 
												<small class="teks-danger">{{ $message }}</small>
											@enderror
										</div>
									</div>

									<div class="form-group row">
										<label for="img-ktp" class="col-sm-2 teks">KTP</label>
										<div class="col-sm-5">
											<input type="hidden" name="data_ktp" value="{{ $peserta->ktp }}">
											<div class="custom-file">
											  <input type="file" class="custom-file-input @error('ktp') is-invalid @enderror" id="img-ktp" onchange="TampilGambarKTP()" name="ktp">
											  <label class="custom-file-label file-ktp" for="img-ktp">{{ $peserta->ktp }}</label>
											</div>
											<img src="/storage/ktp/{{ $peserta->ktp }}" class="img-thumbnail img-preview-ktp" style="width: 100%;height: 220px;">
											<small id="ktp" class="form-text text-muted">JPG, JPEG, PNG, PDF</small>
										</div>
										<div class="col-sm-5">
											@error('ktp') 
												<small class="teks-danger">{{ $message }}</small>
											@enderror
										</div>
									</div>
									<div class="form-group row">
										<label for="img-foto" class="col-sm-2 teks">Foto</label>
										<div class="col-sm-5">
											<input type="hidden" name="data_foto" value="{{ $peserta->foto }}">
											<div class="custom-file">
											  <input type="file" class="custom-file-input @error('foto') is-invalid @enderror" id="img-foto" onchange="TampilGambarFoto()" name="foto">
											  <label class="custom-file-label file-foto" for="customFile">{{ $peserta->foto }}</label>
											</div>
											<img src="/storage/foto/{{ $peserta->foto }}" class="img-thumbnail img-preview-foto" style="width: 200px;height: 250px;">
											<small id="ktp" class="form-text text-muted">JPG, JPEG, PNG, PDF</small>
										</div>
										<div class="col-sm-5">
											@error('foto') 
												<small class="teks-danger">{{ $message }}</small>
											@enderror
										</div>
									</div>
									<div class="form-group row">
										<label for="no_telp" class="col-sm-2 teks">No Telepon</label>
										<div class="col-sm-5">
											<input type="tel" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" name="no_telp" value="{{ $peserta->no_telp }}">
										</div>
										<div class="col-sm-5">
											@error('no_telp') 
												<small class="teks-danger">{{ $message }}</small>
											@enderror
										</div>
									</div>
									<div class="form-group row">
										<label for="t_lahir" class="col-sm-2 teks">Tanggal Lahir</label>
										<div class="col-sm-5">
											<input type="text" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="t_lahir" name="tanggal_lahir" value="{{ $peserta->tanggal_lahir }}">
											<small id="t_lahir" class="form-text text-muted">Contoh: 01 Januari 1990</small>
										</div>
										<div class="col-sm-5">
											@error('tanggal_lahir') 
												<small class="teks-danger">{{ $message }}</small>
											@enderror
										</div>
									</div>
									<div class="form-group row">
										<label for="alamat" class="col-sm-2 teks">Alamat Lengkap</label>
										<div class="col-sm-5">
											<textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ $peserta->alamat }}</textarea>
										</div>
										<div class="col-sm-5">
											@error('alamat') 
												<small class="teks-danger">{{ $message }}</small>
											@enderror
										</div>
									</div>

									<div class="form-group row">
										<div class="col-sm-10">
											<button type="submit" class="btn btn-primary">Simpan</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
@endsection

@section('script')
	<script>
		function TampilGambarKTP(){
			var gambar = document.querySelector('#img-ktp');
			var tampil = document.querySelector('.img-preview-ktp');
			var sampul = document.querySelector('.file-ktp');
			var fileGambar = new FileReader();

			sampul.textContent = gambar.files[0].name;
			
			fileGambar.readAsDataURL(gambar.files[0]);
			
			fileGambar.onload = function(e){
				tampil.src = e.target.result;
			}
				
			tampil.style.display = 'block';
		}

		function TampilGambarFoto(){
			var gambar = document.querySelector('#img-foto');
			var tampil = document.querySelector('.img-preview-foto');
			var sampul = document.querySelector('.file-foto');
			var fileGambar = new FileReader();

			sampul.textContent = gambar.files[0].name;
				
			fileGambar.readAsDataURL(gambar.files[0]);
				
			fileGambar.onload = function(e){
				tampil.src = e.target.result;
			}
				
			tampil.style.display = 'block';
		}

		function Institusi(){
			var x = document.querySelector('#institusi');
			var lain = x.options[x.selectedIndex].value;
			var i = document.querySelector('#lainnya');
			if (lain == 'lain') {
				i.style.display = 'block';
			}else{
				i.style.display = 'none';
			}
		}
	</script>
@endsection