@extends('adm.template.main')


@section('konten')
			<!-- section 1 -->
			<div class="container">
				<h4 class="judul-section">Admin :</h4>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<div class="card shadow">
							<div class="card-header">
								<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i> Tambah</a>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th width="10">No</th>
												<th >Nama Lengkap</th>
												<th >Email</th>
												<th width="250">Pilihan</th>
											</tr>
										</thead>
										<tbody>
										@php
											$no=1;
										@endphp
										@if (count($adm) > 0)
											@foreach ($adm as $a)
											<tr>
												<td>{{ $no++ }}</td>
												<td>{{ $a->name }}</td>
												<td>{{ $a->email }}</td>
												<td>
												@if ($a->id == '1')
													<button class="btn btn-danger" disabled><i class="fas fa-trash"></i></button>
												@else
													<form action="/adm/admin/{{ $a->id }}" method="post">
														@csrf
														@method('DELETE')
														<button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin?')"><i class="fas fa-trash"></i></button>
													</form>
												@endif
												</td>
											</tr>
										@endforeach
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
						<h5 class="modal-title" id="exampleModalLabel">Tambah Admin</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="/adm/admin" method="post">
							@csrf
							@method('POST')

							<div class="row">
								<div class="col-md-4 form-group">
									<label for="nama" class="teks">Nama Lengkap</label>
									<input type="text" class="form-control" name="nama_lengkap" required>
								</div>
								<div class="col-md-4 form-group">
									<label for="email" class="teks">Email</label>
									<input type="email" class="form-control" name="email" required>
								</div>
								<div class="col-md-4 form-group">
									<label for="password" class="teks">Password</label>
									<input type="password" class="form-control" name="password" required>
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

		// $(document).ready(function() {
		// 	$('#dataTable').DataTable();
		// });
	</script>
@endsection