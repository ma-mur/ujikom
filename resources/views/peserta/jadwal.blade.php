@extends('peserta.template.main')

@section('konten')
			<!-- section 1 -->
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<h5 class="py-2 judul-section">Jadwal Ujian Kompetensi :</h5>
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
						<div class="accordion" id="accordionExample">
						@php
							$no=1;
						@endphp

						@if (count($jadwal) > 0)
							@foreach ($jadwal as $j)
								@if ($j->konfirmasi_pembayaran == '1')
									<div class="card shadow border-primary">
										<div class="card-header border-primary" id="heading{{ $j->id }}">
											<h2 class="mb-0 ">
											<button class="btn teks-accordion btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{ $j->id }}" aria-expanded="true" aria-controls="collapse{{ $j->id }}">
											{{ $no++ }}. {{ $j->nama_kompetensi }}
											</button>
											</h2>
										</div>
										<div id="collapse{{ $j->id }}" class="collapse show" aria-labelledby="heading{{ $j->id }}" data-parent="#accordionExample">
											<div class="card-body">
												<div class="row">
													<div class="col-md-3 mb-2">
														<p class="teks-accordion"># Waktu</p>
														<p>Jam : {{ $j->jam }}</p>
														<p>Tanggal : {{ $j->tanggal }}</p>
													</div>
													<div class="col-md-3 mb-2">
														<p class="teks-accordion"># Tempat</p>
														<p>{{ $j->tempat }}</p>
													</div>
													<div class="col-md-3 mb-2">
														<p class="teks-accordion"># Keterangan</p>
														<small>{{ $j->deskripsi }}</small>
													</div>
													<div class="col-md-3 mb-2">
														<p class="teks-accordion"># Asesor</p>
														<p>{{ $j->asesor }}</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								@else
								<p class="text-muted mb-5 mt-5">Belum ada Jadwal</p>
								<br><br><br>
								@endif
							@endforeach
						@else
							<p class="text-muted mb-5 mt-5">Tidak ada Skema Kompetensi yang terdaftar</p>
						<br><br><br>
						@endif
							
						</div>
					</div>
				</div>
			</div>
			
			<!-- section temp -->
@endsection