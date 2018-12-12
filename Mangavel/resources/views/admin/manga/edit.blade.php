@extends('template.main')

@section('title') MangaVel | Tambah Manga  @endsection

@section('header')
<link href="{{asset('templates/css/lib/toastr/toastr.min.css')}}" rel="stylesheet">
@endsection

@section ('body_title') Tambah Manga @endsection

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<form method="POST" class="col-12" action="{{ route('manga-update',['id' => $manga->_id]) }}"  enctype="multipart/form-data">
				<div class="row">
					@csrf
					<div class="col-md-6">
						<div class="col-12 row mr-0 ml-0">
						<div class="col-md-6 pl-0"><label>Old Cover Image</label></div>
						<div class="col-md-6 pr-0"><label>New Cover Image</label></div>
							<div class="col-md-6 pl-0">
								<img src="{{ asset('img/admin/manga/'.$manga->image) }}" class="img-fluid" alt="none" accept="image/*" style="height: 250px;">
							</div>
							<div class="col-md-6 pr-0">
								<img src="{{ asset('img/thumbnail.jpg') }}" class="img-fluid" id="img-cover" alt="none" accept="image/*" style="height: 250px;">

								<div class="col-12 mt-2 pl-0 pr-0">
									<div>
										<input type="hidden" name="old_image" value="{{ $manga->image }}">
										<input type="file" name="image" class="dropzone pl-0 pr-0 col-12 {{ ($errors->has('image'))? 'border-danger' : '' }}" data-toggle="input-file" data-target="#img-cover">
									</div>
									@if ($errors->has('image'))
									<div>
										<span class="text-danger">Note: {{$errors->first('image')}}</span>
									</div>
									@endif
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="row mr-0 ml-0">
							<div class="col-12 mb-2">
								<label>Judul Manga</label>
								<input type="text" name="judul" class="form-control" value="{{ $manga->judul }}" autocomplete="off" required>
							</div>
							<div class="col-12 mb-2">
								<label>Sinopsis</label>
								<textarea name="sinopsis" class="form-control" required style="min-height: 150px;">{{ $manga->sinopsis }}</textarea>
							</div>
						</div>
					</div>
					<div class="col-12 mt-2 mb-2">
						<button class="btn btn-primary pull-right mr-3">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection

@section('footer')
<script src="{{asset('templates/js/lib/toastr/toastr.min.js')}}"></script>
<script src="{{asset('templates/js/custom/toastr.custom.js')}}"></script>
<script type="text/javascript">
	$('[data-toggle="input-file"]').on('change',function(event) {
		var target = $(this).data('target');
		var urlImg = URL.createObjectURL(event.target.files[0]);
		$(target).attr('src', urlImg);
	})
</script>
@endsection