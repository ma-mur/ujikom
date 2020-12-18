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
						<ul class="nav nav-tabs mb-2">
						  	<li class="nav-item">
							    <a class="nav-link {{ (Request::segment(2) == 'belum') ? 'active teks' : '' }}" href="/home/belum">Belum Selesai</a>
						  	</li>
						  	<li class="nav-item">
							    <a class="nav-link {{ (Request::segment(2) == 'sudah') ? 'active teks' : '' }}" href="/home/sudah">Sudah Selesai</a>
						  	</li>
						</ul>
						<div class="accordion" id="accordionExample">

						@php
							$no=1;
						@endphp
						@if (count($kompetensi) > 0)
							
						@foreach ($kompetensi as $k)
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
											<div class="col-md-3 mb-2">
												<p class="teks-accordion"># Kompetensi</p>
												<p class="teks-accordion">Jenis : {{ $k->jenis_kompetensi }}</p>
												<small class="d-block mt-1">Keterangan : {{ $k->deskripsi }}</small>
											</div>
											<div class="col-md-3 mb-2">
												<p class="teks-accordion"># Tagihan</p>
												<h5>
													<span class="badge badge-primary">Rp. {{ number_format($k->tagihan,'0',',','.') }}</span> 
													{{-- <a href="#" class="wiggle" data-toggle="modal" data-target="#info"><i class="fas fa-question-circle"></i></a> --}}
												</h5>
												
												@if ($k->bukti_pembayaran == '')
													<a href="#"  id="bayar" data-toggle="modal" data-target="#pembayaran" data-id="{{ $k->id }}"  class="mt-4 btn btn-secondary w-100">Upload Struk Pembayaran</a>
												@else
		 											<button disabled class="mt-4 btn btn-success w-100">Upload Struk Pembayaran</button>
												@endif
												

												@if ($k->bukti_pembayaran == '')
													<small>Status : <span class="badge badge-danger">Belum Diupload</span></small>
												@else
		 											<small>Status : <span class="badge badge-success">Sudah Diupload</span></small>
												@endif

											</div>
											<div class="col-md-3 mb-2">
												<p class="teks-accordion">&nbsp;</p>
												@foreach ($lapor as $l)
													@if ($l->id_pengajuan == $k->id)
														<a href="/hasil" class="my-1 btn btn-success w-100">Hasil Pengujian</a>
													@endif
												@endforeach

												@if ($k->konfirmasi_pembayaran == '1')
													<a href="/jadwal" class="my-1 btn btn-primary w-100">Jadwal Pengujian</a>
												@endif

												<form action="/bukti" method="post">
													@csrf
													@method('get')
													<input type="hidden" name="id" value="{{ $k->id }}">
													<input type="hidden" name="jenis" value="pendaftaran">
													<button type='submit' class="my-1 btn btn-outline-info w-100">Bukti Pendaftaran</button>	
												</form>
												
												<form action="/bukti" method="post">
													@csrf
													@method('get')
													<input type="hidden" name="id" value="{{ $k->id }}">
													<input type="hidden" name="jenis" value="pembayaran">
													<button type='submit' class="my-1 btn btn-outline-info w-100">Bukti Pembayaran</button>	
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>

						@endforeach
						@else
						<p class="text-muted mb-5 mt-5">Tidak ada Skema Kompetensi yang terdaftar</p>
						<br><br><br>
						@endif
						</div>
					</div>
				</div>
			</div>
			
			{{-- Modal --}}
			{{-- struk --}}
			<div class="modal fade" id="pembayaran" tabindex="-1" aria-labelledby="pembayaran" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Upload Struk Pembayaran</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <form action="/home" method="post" enctype="multipart/form-data">
			        	@csrf
			        	@method('POST')
			      <div class="modal-body">
			        	<input type="hidden" name="id" id="idbayar" readonly>
			        	<div class="form-group row">
							<label for="img-struk" class="col-sm-4 teks">Struk Pembayaran</label>
							<div class="col-sm-8">
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="img-struk" onchange="Struk()" name="bukti" required>
									<label class="custom-file-label file-struk" for="img-struk">Pilih Berkas</label>
								</div>
								<small id="struk" class="form-text text-muted">JPG, PNG (Maks : 2MB)</small>
							</div>
							<div class="col-md-12">
								<img src="" class="img-thumbnail img-preview-struk" style="width: 100%;height: 220px;display: none">
							</div>
						</div>
			        
			      </div>
			      <div class="modal-footer">
			        <button type="submit" class="btn btn-primary">Submit</button>
			      </div>
			      </form>
			    </div>
			  </div>
			</div>

			{{-- info --}}
			{{-- <div class="modal fade" id="info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
			</div> --}}

@endsection


@section('script')
	<script>
		$(document).ready(function(){
				$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

				$('body').on('click','#bayar', function(){
					var tampil = document.querySelector('.img-preview-struk');
					var sampul = document.querySelector('.file-struk');
					var id = $(this).data('id');
					console.log(id)
					$('#pembayaran').modal('show');
					$('#idbayar').val(id);
					$('#img-struk').val('');
					sampul.textContent = 'Pilih Berkas';
					tampil.style.display = 'none';

				});
			})

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