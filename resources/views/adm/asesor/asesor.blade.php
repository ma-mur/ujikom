@extends('adm.template.main')

@section('konten')
			<!-- section 1 -->
			<div class="container">
				<h5 class="judul-section">Data Asesor :</h5>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<div class="card shadow">
							<div class="card-header">
								<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tambahasesor"><i class="fas fa-plus"></i> Tambah</a>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-bordered" id="dataTable">
										<thead>
											<tr>
												<th width="10">No</th>
												<th >Nama Lengkap</th>
												<th >Institusi</th>
												<th >Pilihan</th>
											</tr>
										</thead>
										<tbody>
										@if(count($asesor) > 0)
										<?php $no=1; ?>
											@foreach($asesor as $s)										
											<tr class="{{ ($s->status == '1') ? 'bg-aktif' : '' }}">
												<td>{{ $no++ }}</td>
												<td>{{ $s->nama_lengkap }}</td>
												<td>{{ $s->institusi }}</td>
												<td>
													@if($s->status == 1)
													<form action="/adm/asesor/nonaktif/{{$s->id}}" method="post" class="d-inline">
														{{-- Button Nonaktif --}}
														@csrf
														@method('put')
														<button type="submit" class="btn btn-success"><i class="fas fa-lock-open"></i></button>
													</form>
													@else
													<form action="/adm/asesor/aktif/{{$s->id}}" method="post" class="d-inline">
														{{-- Button Aktif --}}
														@csrf
														@method('put')
														<button type="submit" class="btn btn-secondary"><i class="fas fa-lock"></i></button>
													</form>
													@endif
													
													<form action="/adm/asesor/{{$s->id}}" method="post" class="d-inline">
														{{-- Button Delete --}}
														@csrf
														@method('delete')
														<button type="submit" class="btn btn-danger" onclick="return confirm('Apakah yakin ingin dihapus?')"><i class="fas fa-trash"></i></button>
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
			
			<!-- modal -->
		<div class="modal fade" id="tambahasesor">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Tambah Asesor</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="/adm/asesor" method="post">
							@csrf
							@method('post')
							<div class="row">
								<div class="col-md-6 form-group">
									<label for="nama_lengkap" class="teks">Nama Lengkap</label>
									<input type="text" class="form-control" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
								</div>
								<div class="col-md-6 form-group">
									<label for="institusi" class="teks">Institusi</label>
									<input type="text" name="institusi" class="form-control" value="{{ old('institusi') }}" required>
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
		
		$(document).ready(function() {
			$('#dataTable').DataTable();
		});
	</script>
@endsection