@extends('adm.template.main')

@section('konten')
			<!-- section 1 -->
			<div class="container">
				<h5 class="judul-section">Form Tambah Skema Kompetensi :</h5>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<div class="card shadow">
							<div class="card-header">
								<a href="/adm/skema" class="btn btn-secondary"><i class="fas fa-angle-left"></i> Kembali</a>
							</div>
							<div class="card-body">
								<form action="/adm/skema" method="post">
							@csrf
							@method('post')
							<div class="row">
								<div class="col-md-4 form-group">
									<label for="nama_kompetensi" class="teks">Nama Kompetensi</label>
									<input type="text" class="form-control @error('nama_kompetensi') is-invalid @enderror" name="nama_kompetensi" value="{{ old('nama_kompetensi') }}">
									@error('nama_kompetensi')
										<small class="teks-danger">{{ $message }}</small>
									@enderror
								</div>
								<div class="col-md-4 form-group">
									<label for="harga_stmik" class="teks">Harga (STMIK)</label>
									<div class="input-group mb-2">
							        	<div class="input-group-prepend">
							          		<div class="input-group-text">Rp.</div>
							        	</div>
							        	<input type="text" id="harga_stmik" class="form-control harga @error('harga_stmik') is-invalid @enderror" name="harga_stmik" value="{{ old('harga_stmik') }}">
							      	</div>
							      	@error('harga_stmik')
										<small class="teks-danger">{{ $message }}</small>
									@enderror
								</div>
								<div class="col-md-4 form-group">
									<label for="harga_umum" class="teks">Harga (Umum)</label>
									<div class="input-group mb-2">
							        	<div class="input-group-prepend">
							          		<div class="input-group-text">Rp.</div>
							        	</div>
							        	<input type="text" id="harga_umum" class="form-control harga @error('harga_umum') is-invalid @enderror" name="harga_umum" value="{{ old('harga_umum') }}">
							        </div>
							        @error('harga_umum')
										<small class="teks-danger">{{ $message }}</small>
									@enderror
								</div>
								<div class="col-md-4 form-group">
									<label for="keterangan" class="teks">Keterangan</label>
									<input type="text" class="form-control  @error('keterangan') is-invalid @enderror" name="keterangan" value="{{ old('keterangan') }}">
									@error('keterangan')
										<small class="teks-danger">{{ $message }}</small>
									@enderror
								</div>
								<div class="col-md-4 form-group">
									<label for="jenis_kompetensi" class="teks">Jenis Kompetensi</label>
									<input type="text" class="form-control  @error('jenis_kompetensi') is-invalid @enderror" name="jenis_kompetensi" value="{{ old('jenis_kompetensi') }}">
									@error('jenis_kompetensi')
										<small class="teks-danger">{{ $message }}</small>
									@enderror
								</div>
								<div class="col-md-4 form-group">
									<label for="masa_berlaku" class="teks">Masa Berlaku Sertifikat</label>
									<input type="text" name="masa_berlaku" class="form-control {{-- @error('masa_berlaku') is-invalid @enderror --}}" value="{{ old('masa_berlaku') }}" placeholder="3 Tahun">
								{{-- 	@error('masa_berlaku')
										<small class="teks-danger">{{ $message }}</small>
									@enderror --}}
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
			
			<!-- section temp -->
@endsection

@section('script')
	<script>
		function Promo(){
			var promo = document.getElementById('promo');
			var harga1 = document.getElementById('harga-promo1');
			var harga2 = document.getElementById('harga-promo2');

			if (promo.checked == true) {
				harga1.style.display = 'block';
				harga2.style.display = 'block';
			}else{
				harga1.style.display = 'none';
				harga2.style.display = 'none';
			}
		}

		$('.harga').keyup(function(event) {
		  	if(event.which >= 37 && event.which <= 40){
			    event.defaultPrevented();
			}

			$(this).val(function(index, value) {
				return value
			    .replace(/\D/g, "")
			    .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
			});
		});		
	</script>
@endsection	