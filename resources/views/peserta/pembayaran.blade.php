@extends('peserta.template.main')

@section('konten')
			<!-- section 1 -->
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<h5 class="py-2 judul-section">Pembayaran :</h5>
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
						<div class="card shadow">
							<div class="card-body">
								<div class="table-responsive">
									<table id="dataTable" class="table table-bordered">
										<thead>
											<tr>
												<th width="30">No</th>
												<th width="100">Waktu Pendaftaran</th>
												<th width="100">Skema Kompetensi</th>
												<th width="100">Tagihan</th>
												<th width="100"></th>
											</tr>
										</thead>
										<tbody>
											@php
												$no=1;
											@endphp
											@foreach($kompetensi as $k)
											<tr class="teks-accordion">
												<td>{{ $no++ }}</td>
												<td>{{ $k->tanggal_pengajuan }}</td>
												<td>{{ $k->nama_kompetensi }}</td>
												<td>
													<h5><span class="badge badge-primary">Rp. {{ number_format($k->tagihan,'0',',','.') }}</span></h5>
													
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
												</td>
												<td>
													<form action="/bukti" method="post">
														@csrf
														@method('get')
														<input type="hidden" name="id" value="{{ $k->id }}">
														<input type="hidden" name="jenis" value="pembayaran">
														<button type='submit' class="my-1 btn btn-outline-info w-100">Bukti Pembayaran</button>	
													</form>
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
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

@endsection

@section('script')
	<script>
		$(document).ready(function(){
			$('#dataTable').DataTable();
			$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

			$('body').on('click','#bayar', function(){
				var tampil = document.querySelector('.img-preview-struk');
				var sampul = document.querySelector('.file-struk');
				var id = $(this).data('id');
				// console.log(id)
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