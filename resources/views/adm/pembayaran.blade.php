@extends('adm.template.main')

@section('konten')
			<!-- section 1 -->
			<div class="container">
				<h5 class="py-2 judul-section">Konfirmasi Pembayaran :</h5>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<div class="card shadow">
							<div class="card-body">
								<ul class="nav nav-tabs mb-2">
								  	<li class="nav-item">
									    <a class="nav-link {{ (Request::segment(3) == 'belum') ? 'active teks' : '' }}" href="/adm/pembayaran/belum">Belum Bayar</a>
								  	</li>
								  	<li class="nav-item">
									    <a class="nav-link {{ (Request::segment(3) == 'sudah') ? 'active teks' : '' }}" href="/adm/pembayaran/sudah">Sudah Bayar</a>
								  	</li>
								</ul>
								<div class="table-responsive">
									<table id="dataTable" class="table table-bordered">
										<thead>
											<tr>
												<th width="10">No</th>
												<th>Tanggal Pengajuan</th>
												<th>NIK &amp; nama</th>
												<th>Skema Kompetensi</th>
												<th>Tagihan</th>
												<th>Status</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
										@if (count($pengajuan) >0 )
											@php
												$no = 1;
											@endphp
										@foreach ($pengajuan as $p)
											
											<tr>
												<td>{{ $no++ }}</td>
												<td>{{ $p->tanggal_pengajuan }}</td>
												<td>
													<p>{{ $p->nik }}</p>
													<p>{{ $p->nama_lengkap }}</p>
												</td>
												<td>{{ $p->nama_kompetensi }}</td>
												<td class="text-right">
													Rp. {{ number_format($p->tagihan,'0',',','.') }}
												</td>
												<td class="text-right">
													
													@if ($p->bukti_pembayaran != '')
														<a href="#" class="btn btn-secondary w-100" id="bukti" data-toggle="modal" data-target="#struk" data-id="{{ $p->id }}" >Stuk Pembayaran</a>
													@else
														<button class="btn btn-secondary w-100" disabled>Stuk Pembayaran</button>
													@endif
													


													@if ($p->bukti_pembayaran != '')
														<p><small>Status : <span class="badge badge-success">Sudah Diupload</span></small></p>
													@else
														<p><small>Status : <span class="badge badge-danger">Belum Diupload</span></small></p>
													@endif

												</td>
												<td>
													@if ($p->konfirmasi_pembayaran == 1)
														<button class="btn btn-success w-100" disabled><i class="fas fa-check"></i> Konfirmasi</button>
													@else
														<form action="/adm/pembayaran/konfirmasi/{{ $p->id }}" method="post">
															@csrf
															@method('put')
															<button type="submit" class="btn btn-warning w-100" onclick="return confirm('Apakah bukti sudah diuploadkan?')"><i class="fas fa-check"></i> Konfirmasi</button>
														</form>
														

													@endif

													
												</td>
											</tr>
										@endforeach
										@else

										@endif

										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- section temp -->
			<!-- modal -->
		<div class="modal fade" id="struk">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Struk Pembayaran</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body" id="img">
						
					</div>
				</div>
			</div>
		</div>
@endsection


@section('script')
	<script type="text/javascript">
		@if(session('sukses'))
			Swal.fire(
				'Berhasil',
				'{{ session('sukses') }}',
				'success'
			);
		@endif

		$(document).ready(function(){

			$('#dataTable').DataTable();

			$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

			$('body').on('click','#bukti', function(event){
				event.preventDefault()
				var id = $(this).data('id');
				console.log(id)
				$.get('/adm/pembayaran/bukti/'+id,function(data){
					$('#struk').modal('show');
					$('.modal-body').html('<img src="/storage/bukti/'+data.data.bukti_pembayaran+'" id="gambar" class="img-thumbnail img-preview-ktp" style="width: 100%;">');
				})
			});
		})
	</script>
@endsection