<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bukti {{ $jenis }}</title>

	<style>
		.header{
			width: 100%;
			color: #212121;
		}

		small{
			/*font-weight: 100;*/
			font-size: 12px;
		}

		.judul{
			display: block;
			margin: 0;
			padding: 0;
		}

		.bg-dark{
			background-color: #343a40;
			color: #fff;
			text-align: center;
			border-radius: 5px;
			padding: 0;
			text-transform: uppercase;
		}

		table {
  			border-collapse: collapse;
		}

		.table {
		  width: 100%;
		  margin-bottom: 1rem;
		  color: #212529;
		  border: none;
		}

		.table th,
		.table td {
		  padding: 5px;
		  vertical-align: top;
		  border-top: 1px solid #3d3e48;
		}

		.table thead th {
		  vertical-align: bottom;
		  border-bottom: 2px solid #3d3e48;
		}

		.table tbody + tbody {
		  border-top: 2px solid #3d3e48;
		}

		.table-bordered {
		  border: 1px solid #3d3e48;
		}

		.table-bordered th,
		.table-bordered td {
		  border: 1px solid #3d3e48;
		}

		.table-bordered thead th,
		.table-bordered thead td {
		  border-bottom-width: 2px;
		}

		.table-responsive {
		  	display: block;
		  	width: 100%;
		  	overflow-x: auto;
		  	-webkit-overflow-scrolling: touch;
		}

		.table-responsive > .table-bordered {
			border: 0;
		}
		.table-striped tbody tr:nth-of-type(odd) {
			background-color: rgba(0, 0, 0, 0.05);
		}

		.mt{
			margin-top: 15px;
		}

		.col-md {
		    -ms-flex: 0 0 41.666667%;
		    flex: 0 0 41.666667%;
		    max-width: 41.666667%;
		}
	</style>	
</head>
<body>
	{{-- <table border="0" class="header mt">
		<tr>
			<td class="bg-dark">
				<h4>bukti pendaftaran</h4>
			</td>
		</tr>
	</table> --}}
	
	<table style=" width: 100%;margin-top: 20px;margin-bottom: 20px" border="0">
		{{-- <tr>
			<td rowspan="4" align="center"><img src="{{ asset('images/stmik-sumedang.png') }}" alt="" style="width: 100px"></td>
		</tr>
		<tr>
			<td>Uji Kompetensi STMIK Sumedang</td>
		</tr>
		<tr>
			<td>Jl. Angkrek Situ No.19 Sumedang 45323 | Telp. (0261) 207 395</td>
		</tr>
		<tr>
			<td>Website : https://ujikom.stmik-sumedang.ac.id | Email: info@stmik-sumedang.ac.id</td>
		</tr> --}}
		<tr>
			<td width="100" align="center"><img src="{{ public_path('images/stmik-sumedang.png') }}" width="120" alt=""></td>
			<td align="center">
			<h4 class="judul">SEKOLAH TINGGI MANAJEMEN INFORMATIKA DAN KOMPUTER</h4>
			<h5 class="judul">(STMIK) SUMEDANG</h5>
			<h6 class="judul">TERAKREDITASI</h6>
			<small class="judul">Program Studi : Manajemen Informatika (D3) : SK BAN PT Nomor :0044/SK/BAN-PT/Akred/Dipl-III/I/2017</small>
			<small class="judul">Program Studi : Teknik Informatika (S1) : SK BAN PT Nomor :0155/SK/BAN-PT/Akred/S/I/2017</small>
			<small class="judul">Program Studi : Sistem Informasi (S1) : SK BAN PT Nomor :0342/SK/BAN-PT/Akred/S/I/2017</small>
			<small class="judul">Jalan Angkrek Situ No.19 Telp./Fax. 0261-207395 Sumedang 45323</small>
			<small style="margin: 0 50px 0 0;padding: 0;">Website : www.stmik-sumedang.ac.id</small>
			<small style="margin: 0 0 0 50px;padding: 0;">Email : info@stmik-sumedang.ac.id</small>
			</td>
		</tr>
	</table>

	<hr style="margin: 0 0 2px 0;padding: 0;border: 1.5px solid #000">
	<hr style="margin: 0 0 0 0;padding: 0;">

	<h3 align="center" style="text-transform: uppercase;">Bukti {{ $jenis }}</h3>

<div class="col-md">
	<table class="table" style="margin-top: 20px;">
		<tbody>
			<tr>
				<td style="width: 100px">NIK</td>
				<td style="width: 10px">:</td>
				<td>{{ $detail->nik }}</td>
			</tr>
			<tr>
				<td style="width: 100px">Nama Lengkap</td>
				<td style="width: 10px">:</td>
				<td>{{ $detail->nama_lengkap }}</td>
			</tr>
			<tr>
				<td style="width: 100px">Email</td>
				<td style="width: 10px">:</td>
				<td>{{ $email }}</td>
			</tr>
			<tr>
				<td style="width: 100px">Institusi</td>
				<td style="width: 10px">:</td>
				<td>{{ str_replace('_', ' ', $detail->institusi) }}</td>
			</tr>
		</tbody>
	</table>
</div>

	<table class="table table-bordered" style="margin-top: 20px">
		<thead>
			<tr style="background-color: #eee">
				<th>Skema Kompetensi</th>
				<th>Jenis Kompetensi</th>
				<th>Biaya</th>
				@if ($jenis == 'pendaftaran' )
					<th>Tanggal Pendaftaran</th>
				@else
					<th>Waktu Terkonfirmasi</th>	
				@endif
				
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>{{ $detail->nama_kompetensi }}</td>
				<td>{{ $detail->jenis_kompetensi }}</td>
				<td>Rp. {{ number_format($detail->tagihan,'0',',','.') }}</td>
				@if ($jenis == 'pendaftaran')
					<td>{{ $detail->tanggal_pengajuan }}</td>
				@else
					<td>{{ $detail->waktu_pembayaran }}</td>	
				@endif
				
			</tr>
			@if ($jenis == 'pembayaran')
			<tr>
				<td colspan="2" align="right" style="background-color: #eee">Dibayar</td>
				<td colspan="2">Rp. {{ number_format($detail->tagihan,'0',',','.') }}</td>
			</tr>
			@endif
		</tbody>
	</table>

		<h3 style="margin-top: 50px;margin-bottom: 5px;text-align: center">Keterangan</h3>
		<hr style="margin: 0 0 2px 0;padding: 0;border: 1.5px solid #000">
	@if ($jenis == 'pendaftaran' )
		<p>Jika sudah melakukan pembayaran, unggahkan struk pembayaran untuk mengkonfirmasikan pembayaran.</p>
	@else
		<p>Untuk pelaksanaan Uji Kompetensi dilaksanakan sesuai dengan jadwal yang tertera.</p>
	@endif
</body>
</html>