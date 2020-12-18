@extends('adm.template.main')

@section('konten')
			<!-- section 1 -->
			<div class="container">
				<h5 class="judul-section">Informasi :</h5>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<div class="card shadow">
							<div class="card-body">

								<form action="/adm/informasi/{{$info->id}}" >
									@csrf
									@method('put')
									<div class="row">
										<div class="col-md-12">											
											<textarea name="informasi" id="textareaInformasi">{{ $info->informasi }}</textarea>
										</div>
										<div class="col-md-12 mt-3">
											<button type="submit" class="btn btn-primary">Simpan</button>
										</div>
									</div>
								</form>

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

		CKEDITOR.replace('textareaInformasi',{height:300});
	</script>
@endsection