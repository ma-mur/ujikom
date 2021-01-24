@extends('adm.template.main')

@section('konten')
			<!-- section 1 -->
			<div class="container-fluid">
				<h5 class="judul-section">Data Peserta :</h5>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<div class="card shadow">
							<div class="card-header">
								<a href="/adm/peserta/create" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a>							
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="dataTable" class="table table-bordered">
										<thead>
											<tr>
												<th width="10">No</th>
												<th>NIK</th>
												<th>Nama Lengkap</th>
												<th>Institusi</th>
												<th>Kompetensi</th>
												<th>No Telp</th>
												<th>Tanggal Pendaftaran</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
										@if (count($peserta) > 0)
										<?php $no=1;?>		
											@foreach($peserta as $p)
											<tr>
												<td>{{ $no++ }}</td>
												<td>{{ $p->nik }}</td>
												<td>{{ $p->nama_lengkap }}</td>
												<td>{{ str_replace('_', ' ', $p->institusi) }}</td>
												<td>{{ $p->nama_kompetensi }}</td>
												<td>{{ $p->no_telp }}</td>
												<td>{{ $p->tanggal_pendaftaran }}</td>
												<td>
													<form action="/adm/peserta/{{ $p->id }}" method="post" class="d-inline">
														@csrf
														@method('get')
														<button type="submit" class="btn btn-success"><i class="fas fa-eye"></i></button>
													</form>

													<form action="/adm/peserta/{{ $p->id }}/edit" method="post" class="d-inline">
														@csrf
														@method('get')
														<button type="submit" class="btn btn-info" onclick="return confirm('Hati-hati saat mengedit data! Ingin melanjutkan?')"><i class="fas fa-edit"></i></button>	
													</form>
													
													<form action="/adm/peserta/{{ $p->kode }}" method="post" class="d-inline">
														@csrf
														@method('DELETE')
														<button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda ingin menghapusnya?')"><i class="fas fa-trash"></i></button>	
													</form>

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
@endsection

@section('script')
	<script>
		@if(session('sukses'))
			Swal.fire(
				'Berhasil',
				'{{ session('sukses') }}',
				'success'
			);
		@endif

		$(document).ready(function() {
			$('#dataTable').DataTable();
		});
	</script>
@endsection