@extends('peserta.template.main')

@section('konten')
			<!-- section 1 -->
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<h5 class="py-2 judul-section">Daftar Kompetensi Anda :</h5>		
					</div>
					<div class="col-md-6">
						<div class="text-right mt-2">
							<a href="#" class="my-auto btn btn-primary"><i class="fas fa-question-circle"></i> Bantuan</a>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<div class="accordion" id="accordionExample">

						@php
							$no=1;
						@endphp
						@if (count($laporan) > 0)
							
						@foreach ($laporan as $k)
							<div class="card shadow border-primary">
								<div class="card-header border-primary" id="heading{{ $k->id }}">
									<h2 class="mb-0 ">
									<button class="btn teks-accordion btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{ $k->id }}" aria-expanded="true" aria-controls="collapse{{ $k->id }}">
									{{ $no++ }}. {{ $k->nama_kompetensi }}
									</button>
									</h2>
								</div>
								<div id="collapse{{ $k->id }}" class="collapse show" aria-labelledby="heading{{ $k->id }}" data-parent="#accordionExample">
									<div class="card-body">
										<div class="row">
											<div class="col-md-3 mb-2">
												<p class="teks-accordion"># Waktu Pendaftaran</p>
												<p>{{ $k->tanggal_pengajuan }}</p>
											</div>
											<div class="col-md-4 mb-2">
												<p class="teks-accordion"># Kompetensi</p>
												<p class="teks-accordion">
													Jenis : {{ $k->jenis_kompetensi }} <br>
													Masa Berlaku Sertifikat : {{ $k->masa_berlaku }}
												</p>
												<small class="d-block mt-1">Keterangan : {{ $k->deskripsi }}</small>

											</div>
											@if ($k->status_kompeten == 'Kompeten')
												<div class="col-md-3 mb-2">
													<p class="teks-accordion"># Hasil</p>
													<p>Anda dinyatakan:</p>
													<h4 class="teks-accordion" style="text-transform: uppercase; ">
														{{ $k->status_kompeten }}</h4>
												</div>
												<div class="col-md-2 mb-2">
													<br>
													<img src="{{ asset('images/k.png') }}" alt="" width="100">
												</div>
											@elseif ($k->status_kompeten == 'Belum')
												<div class="col-md-3 mb-2">
													<p class="teks-accordion"># Hasil</p>
													<p>Anda dinyatakan:</p>
													<h4 class="teks-accordion" style="text-transform: uppercase; ">
														{{ $k->status_kompeten }} Kompeten</h4>
												</div>
												<div class="col-md-2 mb-2">
													<br>
													<img src="{{ asset('images/bk.png') }}" alt="" width="100">
												</div>
											@endif
										</div>
									</div>
								</div>
							</div>

						@endforeach
						@else

						@endif
						</div>
					</div>
				</div>
			</div>
			
			{{-- Modal --}}
			{{-- struk --}}
			<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Upload Struk Pembayaran</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <form action="" method="post" enctype="multipart/form-data">
			        	<div class="form-group row">
							<label for="img-struk" class="col-sm-4 teks">Struk Pembayaran</label>
							<div class="col-sm-8">
								<div class="custom-file">
									<input type="file" class="custom-file-input @error('struk') is-invalid @enderror" id="img-struk" onchange="Struk()" name="struk">
									<label class="custom-file-label file-struk" for="img-struk">Pilih Berkas</label>
								</div>
								<small id="struk" class="form-text text-muted">JPG, PNG (Maks : 2MB)</small>
							</div>
							<div class="col-md-12">
								<img src="" class="img-thumbnail img-preview-struk" style="width: 100%;height: 220px;display: none">
							</div>
							<div class="col-sm-12">
								@error('struk')
								<small class="teks-danger">{{ $message }}</small>
								@enderror
							</div>
						</div>
			        </form>
			      </div>
			      <div class="modal-footer">
			        <button type="submit" class="btn btn-primary">Submit</button>
			      </div>
			    </div>
			  </div>
			</div>

			{{-- info --}}
			<div class="modal fade" id="info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Bantuan</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <p>Lakukan Pembayaran sesuai dengan tagihan dengan mendatangi bagian BAAK STMIK Sumedang dengan memperlihatkan/menyertakan <span class="badge badge-primary">BUKTI PENDAFTARAN</span></P>
			        <p>Setelah selesai melakukan pembayaran, upload struk pembayaran untuk konfirmasikan pembayaran</p>
			      </div>
			    </div>
			  </div>
			</div>

@endsection


@section('script')
<script>
	function Struk(){
		var gambar = document.querySelector('#img-struk');
		var tampil = document.querySelector('.img-preview-struk');
		var sampul = document.querySelector('.file-struk');
		var fileGambar = new FileReader();

		sampul.textContent = gambar.files[0].name;
			
		fileGambar.readAsDataURL(gambar.files[0]);
			
		fileGambar.onload = function(e){
			tampil.src = e.target.result;
		}
				
		tampil.style.display = 'block';
	}
</script>

@endsection