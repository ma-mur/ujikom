@extends('template.main')

@section('konten')
			<!-- section 1 -->
			<div class="container section1">
				<div class="row">
					<div class="col-md-5 my-auto mb-3 order-md-2">
						<img src="{{ asset('images/bg2.png') }}" class="rounded mx-auto d-block w-100">
					</div>
					<div class="col-md-7 mb-3 order-md-1">
						<h1 class="mb-3 text-left judul">Uji Kompetensi</h1>
						{{-- {{ date('d m y H:i:s a') }} --}}
						{{-- {{ time() }} --}}
						{{-- {{ config('app.name') }} --}}
						<p class="lead">Daftarkan diri Anda segera untuk mengetahui apakah Anda telah kompeten atau belum kompeten pada suatu unit kompetensi tertentu.</p>
						<div class="row">
							<div class="col-md-6 my-1">
								<a href="/masuk" class="btn btn-lg btn-outline-secondary w-100">MASUK</a>
							</div>
							<div class="col-md-6 my-1">
								<a href="/daftar" class="btn btn-lg btn-primary w-100">DAFTAR</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- section 2 -->
			<div class="container-fluid bg-utama text-center">
				<div class="row">
					<div class="col-md-3 my-5">
						<i class="fas fa-sign-in-alt fa-3x"></i>
						<h5 class="lead mb-3">MASUK/DAFTAR</h5>
						<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cum ad deleniti aperiam commodi exercitationem nam. Voluptatibus id illo, reprehenderit. Veritatis quia placeat labore, nulla fugit non repellendus facilis obcaecati quidem.</p>
					</div>
					<div class="col-md-3 my-5">
						<i class="fas fa-dollar-sign fa-3x"></i>
						<h5 class="lead mb-3">PEMBAYARAN</h5>
						<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cum ad deleniti aperiam commodi exercitationem nam. Voluptatibus id illo, reprehenderit. Veritatis quia placeat labore, nulla fugit non repellendus facilis obcaecati quidem.</p>
					</div>
					<div class="col-md-3 my-5">
						<i class="fas fa-tasks fa-3x"></i>
						<h5 class="lead mb-3">PENGUJIAN</h5>
						<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cum ad deleniti aperiam commodi exercitationem nam. Voluptatibus id illo, reprehenderit. Veritatis quia placeat labore, nulla fugit non repellendus facilis obcaecati quidem.</p>
					</div>
					<div class="col-md-3 my-5">
						<i class="fas fa-file fa-3x"></i>
						<h5 class="lead mb-3">SERTIFIKAT</h5>
						<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cum ad deleniti aperiam commodi exercitationem nam. Voluptatibus id illo, reprehenderit. Veritatis quia placeat labore, nulla fugit non repellendus facilis obcaecati quidem.</p>
					</div>
				</div>
			</div>
			<!-- section 3 -->
			<div class="container py-5" id="informasi">
				<h1 class="text-center py-4 judul-section">Informasi</h1>
				<div class="row my-3">
					<div class="col-md-12 my-1">
						<div class="card shadow">
							<div class="card-body">
								{!! $info->informasi !!}
							</div>
						</div>
					</div>
				</div>
				<hr>
			</div>
			<!-- section 4 -->
			<div class="container py-5" id="harga">
				<h1 class="text-center py-4 judul-section">Harga</h1>
				<div class="row my-3">
					@if (count($skema) > 0)
						@foreach ($skema as $s)
							<div class="col-md-4 my-1">
								<div class="card border-primary shadow">
									<div class="card-header" style="height: 100px">
										@if ($s->status_promo == '1')
											<div class="corner-ribbon">Promo!!</div>
										@endif										

										<h4 class="judul">{{ $s->nama_kompetensi }}</h4>
									</div>
									<div class="card-body text-center">
										<p>{{ $s->deskripsi }}</p>
										<p class="lead">STMIK Sumedang</p>
										<h3 class="judul-section">
											@if ($s->status_promo == '1')
												Rp. {{ number_format($s->promo_stmik,'0',',','.') }}
											@else
												Rp. {{ number_format($s->harga_stmik,'0',',','.') }}
											@endif
										</h3>
										<hr class="border-primary">
										<p class="lead">Umum</p>
										<h3 class="mb-5 judul-section">
											@if ($s->status_promo == '1')
												Rp. {{ number_format($s->promo_umum,'0',',','.') }}
											@else
												Rp. {{ number_format($s->harga_umum,'0',',','.') }}
											@endif
										</h3>
										<a href="/daftar" class="btn btn-primary w-100">Daftar</a>
									</div>
								</div>
							</div>	
						@endforeach
					@endif					
				</div>
				<hr>
			</div>
			<!-- section 5 -->
			<div class="container py-5" id="kompeten">
				<h1 class="text-center py-4 judul-section">Data Kompeten</h1>
				<div class="row">
					<div class="col-md-12">
						<div class="card border-secondary shadow">
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-bordered w-100" id="dataTable">
										<thead>
											<tr>
												<th>No</th>
												<th>Tahun</th>
												<th>Skema Kompetensi</th>
												<th>Kompeten</th>
												<th>Belum Kompeten</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>1</td>
												<td>2020</td>
												<td>Web Designer</td>
												<td>30 Orang</td>
												<td>14 Orang</td>
											</tr>
										</tbody>
										
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
@endsection

@section('script')
	<script>
		$(document).ready(function() {
			$('#dataTable').DataTable();
			$('[data-toggle="tooltip"]').tooltip();
		});
	</script>
@endsection
