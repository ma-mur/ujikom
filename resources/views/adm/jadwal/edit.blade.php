@extends('adm.template.main')

@section('konten')
			<!-- section 1 -->
			<div class="container">
				<h5 class="judul-section">Jadwal Kompetensi :</h5>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<div class="card shadow">
							<div class="card-header">
								<a href="/adm/jadwal" class="btn btn-secondary"><i class="fas fa-angle-left"></i> Kembali</a>
							</div>
							<div class="card-body">
								<form action="/adm/jadwal/{{ $jadwal->id }}" method="post">
									@csrf
									@method('put')
									<div class="row">
										<div class="col-md-4 form-group">
											<label for="jam" class="teks">Jam</label>
											<input type="text" class="form-control @error('jam') is-invalid @enderror" name="jam" value="{{ $jadwal->jam }}">
											@error('jam')
											<small class="teks-danger">{{ $message }}</small>
											@enderror
										</div>
										<div class="col-md-4 form-group">
											<label for="tanggal" class="teks">tanggal</label>
											<input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" value="{{ $jadwal->tanggal }}">
											@error('tanggal')
											<small class="teks-danger">{{ $message }}</small>
											@enderror
										</div>
										<div class="col-md-4 form-group">
											<label for="tempat" class="teks">Tempat</label>
											<input type="text" class="form-control @error('tempat') is-invalid @enderror" name="tempat" value="{{ $jadwal->tempat }}">
											@error('tempat')
											<small class="teks-danger">{{ $message }}</small>
											@enderror
										</div>
										<div class="col-md-6 form-group">
											<label for="skema" class="teks">Skema Kompetensi</label>
											<select class="form-control @error('skema') is-invalid @enderror" name="skema">
												<option selected disabled>-- Pilih --</option>
												@foreach($skema as $s)
													@if ($jadwal->id_kompetensi == $s->id)
														<option value="{{ $s->id }}" selected>{{ $s->nama_kompetensi }}</option>
													@else
														<option value="{{ $s->id }}">{{ $s->nama_kompetensi }}</option>
													@endif
												@endforeach
											</select>
											@error('skema')
											<small class="teks-danger">{{ $message }}</small>
											@enderror
										</div>
										<div class="col-md-6 form-group">
											<label for="asesor" class="teks">Asesor</label>
											<select class="form-control @error('asesor') is-invalid @enderror" name="asesor">
												<option selected disabled>-- Pilih --</option>
												@foreach($asesor as $s)
													@if ($jadwal->asesor == $s->nama_lengkap)
														<option value="{{ $s->nama_lengkap }}" selected>{{ $s->nama_lengkap }}</option>
													@else
														<option value="{{ $s->nama_lengkap }}">{{ $s->nama_lengkap }}</option>
													@endif
												@endforeach
											</select>
											@error('asesor')
											<small class="teks-danger">{{ $message }}</small>
											@enderror
										</div>
										<div class="col-md-12 form-group">
											<label for="keterangan" class="teks">Keterangan</label>
											<textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror">{{ $jadwal->deskripsi }}</textarea>
											@error('keterangan')
											<small class="teks-danger">{{ $message }}</small>
											@enderror
										</div>
										<div class="col-md-12 form-group">
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