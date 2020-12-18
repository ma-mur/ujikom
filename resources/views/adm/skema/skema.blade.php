@extends('adm.template.main')

@section('konten')
			<!-- section 1 -->
			<div class="container">
				<h5 class="judul-section">Skema Kompetensi :</h5>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<div class="card shadow">
							<div class="card-header">
								<a href="/adm/skema/create" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-bordered" id="dataTable">
										<thead>
											<tr>
												<th width="10">No</th>
												<th >Nama Kompetensi</th>
												<th >Harga</th>
												<th width="50">Status Promo</th>
												<th >Harga Promo</th>
												<th width="100">Masa Berlaku Sertifikat</th>
												<th >Pilihan</th>
											</tr>
										</thead>
										<tbody>
										@if(count($skema) > 0)
										<?php $no=1; ?>
											@foreach($skema as $s)										
											<tr class="{{ ($s->status == '1') ? 'bg-aktif' : '' }}">
												<td>{{$no++}}</td>
												<td>
													<p class="teks-accordion">{{$s->nama_kompetensi}}</p>
													<small>{{$s->deskripsi}}</small>
												</td>
												<td>
													<p>(STMIK) : Rp. {{ number_format($s->harga_stmik,'0',',','.') }}</p>
													<p>(UMUM) : Rp. {{ number_format($s->harga_umum,'0',',','.') }}</p>
												</td>
												<td>
													@if($s->status_promo == 1)
														<p class="teks-accordion">Aktif</p>
													@endif
												</td>
												<td>
													@if($s->status_promo == 1)
														<p>(STMIK) : Rp. {{ number_format($s->promo_stmik,'0',',','.') }}</p>
														<p>(UMUM) : Rp. {{ number_format($s->promo_umum,'0',',','.') }}</p>
													@endif
												</td>
												<td>{{ $s->masa_berlaku }}</td>
												<td>
													@if($s->status == 1)
													<form action="/adm/skema/nonaktif/{{$s->id}}" method="post" class="d-inline">
														{{-- Button Nonaktif --}}
														@csrf
														@method('put')
														<button type="submit" class="btn btn-success"><i class="fas fa-lock-open"></i></button>
													</form>
													@else
													<form action="/adm/skema/aktif/{{$s->id}}" method="post" class="d-inline">
														{{-- Button Aktif --}}
														@csrf
														@method('put')
														<button type="submit" class="btn btn-secondary"><i class="fas fa-lock"></i></button>
													</form>
													@endif
													
													<form action="/adm/skema/{{$s->id}}/edit" method="post" class="d-inline">
														{{-- Button Edit --}}
														@csrf
														@method('get')
														<button type="submit" class="btn btn-info"><i class="fas fa-edit"></i></button>
													</form>
													
													<form action="/adm/skema/{{$s->id}}" method="post" class="d-inline">
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