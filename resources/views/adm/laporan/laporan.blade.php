@extends('adm.template.main')

@section('konten')
			<!-- section 1 -->
			<div class="container mt-2">
			{{-- 	<h4 class="judul-section">Laporan :</h4> --}}
			<div class="row">
				<div class="col-sm-5">
					<form action="/adm/laporan" method="post" class="d-inline w-100">
						@csrf
						@method('post')
						<div class="form-group row">
							<label for="tahun" class="col-sm-2 teks">Tahun</label>
							<div class="col-sm-8 mb-2">
								<select name="tahun" id="tahun" class="form-control" onchange="Tahun()">
									<option value="" selected>Semua</option>
									@if (count($gruptahun) > 0)
										@foreach($gruptahun as $t)
											{{ $tahun[] = $t->tahun }}
											@if ($t->tahun == $year)
												<option value="{{ $t->tahun }}" selected>{{ $t->tahun }}</option>
											@else
												<option value="{{ $t->tahun }}">{{ $t->tahun }}</option>
											@endif
										@endforeach
									@else
									
									@endif
								</select>
							</div>
							<div class="col-sm-2">
								<button type="submit" class="btn btn-primary">Filter</button>
							</div>						
						</div>
					</form>
				</div>
				<div class="col-md-4">
					<form action="/adm/laporan/pdf" method="post">
						@csrf
						@method('POST')
						<input type="hidden" name="tahun" value="" id="taun">
						<button class="btn btn-success" type="submit"><i class="fas fa-download"></i> Detail PDF</button>
					</form>
				</div>
			</div>				
				<hr>
			{{-- 	<div class="form-group row">
					<label for="nama" class="col-sm-2 teks">Masa Berlaku Sertifikat</label>
					<div class="col-sm-3 mb-2">
						<input type="text" class="form-control" id="nama">
					</div>
					<div class="col-sm-3">
						<button class="btn btn-info">Simpan</button>
					</div>
					<div class="col-sm-4 text-left">
						
					</div>
				</div> --}}
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							{{-- <div class="col-md-5 mb-2">
								<div class="card shadow">
									<div class="card-body">
										<canvas id="myChart" width="400" height="400"></canvas>
									</div>
								</div>
							</div> --}}
							<div class="col-md-12">
								<div class="card shadow	">
									<div class="card-body">
										<div class="table-responsive">
											<table id="dataTable" class="table table-striped table-bordered">
												<thead>
													<tr>
														<th class="tcenter">Tahun</th>
														<th class="tcenter">Skema Kompetensi</th>
														<th class="tcenter">Status Kompeten</th>
														<th class="tcenter">jumlah</th>
													</tr>	
												</thead>
												<tbody>
													@foreach($laporan as $l)
													<tr>
														<td class="tcenter">{{ $l->tahun }}</td>
														<td class="tcenter">{{ $l->nama_kompetensi }}</td>
														<td class="tcenter">{{ $l->status_kompeten }}</td>
														<td class="tright">{{ $l->jumlah }}</td>
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
				</div>
			</div>
			<!-- section temp -->
@endsection

@section('script')
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        {{-- labels: {{ json_encode($tahun) }}, --}}
        datasets: [{
            label: '# Kompeten',
            data: [73,123],
            backgroundColor: [
                'rgba(62, 101, 160, 1)',
                'rgba(62, 101, 160, 1)',
            ],
            borderColor: [
                'rgba(62, 101, 160, 1)',
                'rgba(62, 101, 160, 1)',
            ],
            borderWidth: 1
        },{
            label: '# Belum Kompeten',
            data: [22,0],
            backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
<script>
	function Tahun(){
		var a = document.querySelector('#taun');
		a.value = $('#tahun').val();
	}

	$(document).ready(function(){
		$('#dataTable').DataTable();
	});
</script>
@endsection