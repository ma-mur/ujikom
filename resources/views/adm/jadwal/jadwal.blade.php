@extends('adm.template.main')

@section('konten')
			<!-- section 1 -->
			<div class="container-fluid">
				<h5 class="judul-section">Jadwal Kompetensi :</h5>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<div class="card shadow">
							<div class="card-header">
								<a href="/adm/jadwal/create" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-bordered" id="dataTable">
										<thead>
											<tr>
												<th width="10">No</th>
												<th>Jam</th>
												<th>Tanggal</th>
												<th>Tempat</th>
												<th>Skema Kompetensi</th>
												<th width="300">Keterangan</th>
												<th>Asesor</th>
												<th>Pilihan</th>
											</tr>
										</thead>
										<tbody>
											@if (count($jadwal) > 0)
											<?php $no=1;?>	
											@foreach($jadwal as $j)
											<tr>
												<td>{{ $no++ }}</td>
												<td>{{ $j->jam }}</td>
												<td>{{ $j->tanggal }}</td>
												<td>{{ $j->tempat }}</td>
												<td>{{ $j->nama_kompetensi }}</td>
												<td>
													<small>{{ $j->deskripsi }}</small>
												</td>
												<td>{{ $j->asesor }}</td>
												<td>

													<form action="/adm/jadwal/{{ $j->id }}/edit" method="post" class="d-inline">
														@csrf
														@method('get')
														<button class="btn btn-info"><i class="fas fa-edit"></i></button>
													</form>

													<form action="/adm/jadwal/{{ $j->id }}" method="post" class="d-inline">
														@csrf
														@method('delete')
														<button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapusnya?')"><i class="fas fa-trash"></i></button>
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
		<!-- modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Tambah Jadwal Kompetensi</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6 form-group">
								<label for="nama" class="teks">Waktu</label>
								<input type="date" class="form-control">
							</div>
							<div class="col-md-6 form-group">
								<label for="nama" class="teks">Tempat</label>
								<input type="text" class="form-control">
							</div>
							<div class="col-md-6 form-group">
								<label for="nama" class="teks">Skema Kompetensi</label>
								<select class="form-control">
									<option selected disabled>-- Pilih --</option>
									<option value="">Web Designer</option>
									<option value="">Web Programmer</option>
								</select>
							</div>
							<div class="col-md-6 form-group">
								<label for="nama" class="teks">Deskripsi</label>
								<input type="text" class="form-control">
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" class="btn btn-primary">Simpan</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Edit Skema Kompetensi</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6 form-group">
								<label for="nama" class="teks">Waktu</label>
								<input type="date" class="form-control">
							</div>
							<div class="col-md-6 form-group">
								<label for="nama" class="teks">Tempat</label>
								<input type="text" class="form-control">
							</div>
							<div class="col-md-6 form-group">
								<label for="nama" class="teks">Skema Kompetensi</label>
								<select class="form-control">
									<option selected disabled>-- Pilih --</option>
									<option value="">Web Designer</option>
									<option value="">Web Programmer</option>
								</select>
							</div>
							<div class="col-md-6 form-group">
								<label for="nama" class="teks">Deskripsi</label>
								<input type="text" class="form-control">
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" class="btn btn-primary">Simpan</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
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