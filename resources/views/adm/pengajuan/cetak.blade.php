<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Data Peserta</title>

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

		table {
  			border-collapse: collapse;
		}

		.table {
		  width: 100%;
		  margin-bottom: 1rem;
		  color: #212529;
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
	</style>	
</head>
<body>
	<table border="0" class="header">
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
	<hr style="margin: 1px 0 2px 0;padding: 0;border: 1.5px solid #000">
	<hr style="margin: 0 0 0 0;padding: 0;">
	

	<h3 align="center">Data Peserta Uji Kompetensi</h3>
	<table class="table table-bordered" style="margin-top: 20px">
		<thead>
			<tr>
				<th>No</th>
				<th>NIK</th>
				<th>Nama Lengkap</th>
				<th>Institusi</th>
				<th>Skema Kompeteni</th>
			</tr>		
		</thead>
		<tbody>
			@php
				$no=1;
			@endphp
			@foreach ($cetak as $c)
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $c->nik }}</td>
				<td>{{ $c->nama_lengkap }}</td>
				<td>{{ str_replace('_', ' ', $c->institusi) }}</td>
				<td>{{ $c->nama_kompetensi }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

</body>
</html>