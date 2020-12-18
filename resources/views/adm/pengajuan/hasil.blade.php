@extends('adm.template.main')

@section('konten')
			<!-- section 1 -->
			<div class="container">
				<h5 class="judul-section">Data Pendaftar :</h5>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<div class="card shadow">
							<div class="card-header">
								<form action="/adm/hasil/cetak" method="post">
									@csrf
									@method('post')
									<div class="row">
										<div class="col-md-3">
											<select name="skema" id="" class="form-control">
												@if (count($pengajuan) > 0)
													<option value="semua" selected>Cetak Semua</option>
												@else

												@endif
												
												@foreach ($skema as $s)
													<option value="{{ $s->id_kompetensi }}">{{ $s->nama_kompetensi }}</option>
												@endforeach
											</select>	
										</div>
										<div class="col-md-2">
											<button type="submit" class="btn btn-success"><i class="fas fa-print"></i> Cetak</button>
										</div> 
									</div>
								</form>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="dataTable" class="table table-bordered">
										<thead>
											<tr>
												<th width="10">No</th>
												<th>Waktu Pendaftaran</th>
												<th>NIK</th>
												<th>Nama Lengkap</th>
												<th>Skema Kompetensi</th>
												<th>Tagihan</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
										@if (count($pengajuan) > 0)
										<?php $no=1;?>
											@foreach($pengajuan as $p)
												<tr>
													<td>{{ $no++ }}</td>
													<td>{{ $p->tanggal_pengajuan }}</td>
													<td>{{ $p->nik }}</td>
													<td>{{ $p->nama_lengkap }}</td>
													<td>{{ $p->nama_kompetensi }}</td>
													<td class="text-right">
														{{-- @if ($p->status_promo == '1')
															<p class="teks"><i class="fas fa-gift"></i> Promo</p>
														@endif --}}
														
														Rp. {{ number_format($p->tagihan,'0',',','.') }}

														@if ($p->bukti_pembayaran != '')
															<p><small>Status : <span class="badge badge-success">Sudah Dibayar</span></small></p>
														@else
															<p><small>Status : <span class="badge badge-danger">Belum Dibayar</span></small></p>
														@endif
														
													</td>
													<td>
													@if ($p->konfirmasi_pembayaran == '1')
														<a href="#" class="btn btn-success w-100" id="nilai" data-toggle="modal" data-target="#tambahnilai" data-id="{{ $p->id }}" ><i class="fas fa-award"></i> Nilai</a>
													@else
														<button class="btn btn-secondary w-100" disabled><i class="fas fa-award"></i> Nilai</button>
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
		<div class="modal fade" id="tambahnilai">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Hasil</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="/adm/hasil" method="post">
							@csrf
							@method('post')

							<input id="id" type="hidden" name="id" readonly>
							<input id="tanggal_pengajuan" type="hidden" name="tanggal" readonly>
							<div class="form-group row">
								<label for="nik" class="col-sm-4 teks">NIK :</label>
								<div class="col-sm-8 mt-0">
									<input id="nik" type="text" name="nik" readonly class="form-control">
								</div>
							</div>
							<div class="form-group row">
								<label for="nama_lengkap" class="col-sm-4 teks">Nama Lengkap :</label>
								<div class="col-sm-8 mt-0">
									<input id="nama_lengkap" type="text" name="nama_lengkap" readonly class="form-control">
								</div>
							</div>
							<div class="form-group row">
								<label for="institusi" class="col-sm-4 teks">Institusi :</label>
								<div class="col-sm-8 mt-0">
									<input id="institusi" type="text" name="institusi" readonly class="form-control">
								</div>
							</div>
							<div class="form-group row">
								<label for="kompetensi" class="col-sm-4 teks">Skema Kompetensi :</label>
								<div class="col-sm-8 mt-0">
									<input id="id_kompetensi" type="hidden" name="id_kompetensi" readonly>
									<input id="kompetensi" type="text" name="kompetensi" readonly class="form-control">
								</div> 
							</div>
							<div class="form-group row">
								<label for="tahun" class="col-sm-4 teks">Tahun :</label>
								<div class="col-sm-8 mt-0">
									<input id="tahun" type="text" name="tahun" value="{{ date('Y') }}" class="form-control">
								</div>
							</div>
							<div class="form-group row">
								<label for="status" class="col-sm-4 teks">Dinyatakan :</label>
								<div class="col-sm-8 mt-0">
									<select name="status" class="form-control" required>
										<option selected disabled>-- Pilih --</option>
										<option value="Kompeten">Kompeten</option>
										<option value="Belum">Belum Kompeten</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</form>
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

			$.ajaxSetup({
			    headers: {
			            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
			});

			$('body').on('click','#nilai', function(event){
				event.preventDefault()
				var id = $(this).data('id');
				// console.log(id)
				$.get('/adm/hasil/'+id,function(data){
					var institusi = data.data[0].institusi;
					$('#tambahnilai').modal('show');
					$('#id').val(data.data[0].id);
					$('#nik').val(data.data[0].nik);
					$('#nama_lengkap').val(data.data[0].nama_lengkap);
					$('#institusi').val(institusi.replace('_',' '));
					$('#kompetensi').val(data.data[0].nama_kompetensi);
					$('#id_kompetensi').val(data.data[0].id_kompetensi);
					$('#tanggal_pengajuan').val(data.data[0].tanggal_pengajuan);
				})
			});
		})
	</script>
@endsection