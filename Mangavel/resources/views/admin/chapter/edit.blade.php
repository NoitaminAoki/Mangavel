@extends('template.main')

@section('title') MangaVel | Edit Chapter  @endsection

@section('header')
<link href="{{asset('templates/css/lib/toastr/toastr.min.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('js/jquery-ui.min.css') }}">

<style type="text/css">

.loader{
	display: none;
	position: absolute;
	top: 0; left: 0; right: 0; bottom: 0;
	z-index: 1000;
	background: rgba(220,220,220,0.9);
}
</style>
@endsection

@section ('body_title') Edit Chapter @endsection

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card card-outline-primary">
			<div class="card-body">
				<div class="card-title text-center">Edit Chapter</div>
				<div class="card-subtitle text-center">lorem ipsum dolor set amet</div>
				<form method="post" action="{{ route('chapter-update') }}" enctype="multipart/form-data" onsubmit="return confirm('Are you sure?')">
					@csrf
					<input type="hidden" name="idChapter" value="{{ $data->chapter->_id }}">
					<input type="hidden" name="idManga" value="{{ $data->chapter->manga->_id }}">
					<div class="row mx-0">
						<div class="form-group col-md-6">
							<label>Judul</label>
							<input type="text" name="judul" class="form-control" autocomplete="off" value="{{ $data->chapter->judul }}" required>
						</div>
						<div class="form-group col-md-6">
							<label>Chapter ke-</label>
							<input type="text" id="chapter" name="nomor" class="form-control" autocomplete="off" value="{{ $data->chapter->nomor }}" required>
						</div>
						<div class="form-group col-12">
							<label>Image</label>
							<br>
							<div class="row mx-0">
								<div class="col-md-2 px-0">
									<select class="form-control" style="width: 70px;" id="number-row">
										<option value="1" selected>1</option>
										<option value="5">5</option>
										<option value="10">10</option>
										<option value="15">20</option>
									</select>
								</div>
								<div class="col-md-10">
									<button type="button" id="add-img" class="btn btn-primary"><i class="fa fa-plus"></i></button>
								</div>
							</div>
						</div>
						<div id="container-img" class="col-12">
							@foreach ($data->image as $key => $value)
							<div class="media col-md-8 mb-2">
								<div class="loader align-items-center ">
									<label class="font-weight-bold text-center w-100 loading-text">Being Process</label>
								</div>
								<div class="media-left pr-3">
									<label class="number">{{ ($key+1) }}). </label>
									<img src="{{ asset('img/admin/manga/'.$data->chapter->manga->_id).("/".$value->name) }}" class="img-fluid rounded" alt="none" style="height: 140px;width: 130px;">
									<br>
									<label class="px-2 dropzone bg-white font-weight-bold text-center float-right" style="vertical-align: top; width: 130px;">Gambar Lama</label>
								</div>
								<div class="media-left pr-3 media-new-img">
									<img src="{{ asset('img/thumbnail.jpg') }}" class="img-fluid rounded new-img" alt="none" style="height: 140px;width: 130px;">
									<br>
									<label class="px-2 dropzone bg-white font-weight-bold text-center float-right" style="vertical-align: top; width: 130px;">Gambar Baru</label>
								</div>
								<div class="media-body" style="height: 90px;">
									<input type="hidden" name="_idImage[]" value="{{ $value->_id }}">
									<input type="file" name="image[]" class="dropzone w-100 {{ ($errors->has('image'))? 'border-danger' : '' }}" data-toggle="input-file-new" accept="image/*">
									<div class="mt-2">
										<button type="button" class="btn btn-danger btn-sm float-right btn-delete-ch"><i class="fa fa-close"></i></button>
										<button type="button" class="w-25 mx-1 btn btn-warning btn-sm btn-add-after float-right"><i class="fa fa-plus"></i> After</button>
									</div>
								</div>
							</div>
							@endforeach
						</div>
						@if ($errors->any())
						<div>
							<span class="text-danger">Note: 
								<ul>
									<li>- The File must be an image.</li>
									<li>- The File must be a file of type: jpeg, jpg, png.</li>
									<li>- Max size of file is 2MB.</li>
								</ul>
							</span>
						</div>
						@endif
						<div class="form-group col-12 mt-3 mb-0">
							<button type="submit" id="btn-back" class="btn btn-primary float-right" style="width: 100px;">Update</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection

@section('footer')
<script src="{{asset('templates/js/lib/toastr/toastr.min.js')}}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/handlebars-v4.0.12.js') }}"></script>
<script src="{{asset('templates/js/custom/toastr.custom.js')}}"></script>
<script type="text/javascript">
	
	var definingRow = function() {
		var getRow = $("#container-img>div.media>div.media-left>label.number");
		getRow.each(function(index, value) {
			$(this).text((index+1)+"). ");
		})
	};

	$(document).on("click", ".btn-add-after",function() {
		var container = $(this).closest('div .media');
		var template = Handlebars.compile($("#box-img").html());
		var endTemplate = template();
		container.after(endTemplate);
		definingRow();
	});

	$(document).on("click", ".btn-delete-ch", function() {
		var msg = confirm('Are you sure?');
		if(msg){
			var routes = "{{ route('image-delete') }}";
			var csrf_token = "{{ csrf_token() }}";
			var idMng = "{{ $data->chapter->manga->_id }}";
			var parent = $(this).closest('div .media');
			var idImg = parent.children('div .media-body').find('input:hidden').val();
			var getLoader = parent.find('div.loader');
			getLoader.show('fade', 300);
			getLoader.addClass('d-flex');
			$.ajax({
				url: routes,
				type: "POST",
				data: { '_token': csrf_token, '_id': idImg, 'idmng': idMng},
				success: function(data) {
					console.log(data);
					if(data.status == 200){
						setTimeout(function() {
							getLoader.children('label').text("Success!");
							setTimeout(function() {
								parent.remove();
								definingRow();
							},1000);
						}, 2000);
					}
				},
				error: function(xhr, status, message) {
					alert('error');
				}
			});
		}
	});


	$(document).on("click", ".btn-delete", function() {
		$(this).closest('div .media').remove();
		definingRow();
	});

	$(document).on('change', 'input:file[data-toggle="input-file-new"]',function(event) {
		var target = $(this).closest('div .media').children('div .media-new-img').find('img.new-img');
		var urlImg = URL.createObjectURL(event.target.files[0]);
		target.attr('src', urlImg);
	});

	$(document).on('change', '[data-toggle="input-file"]',function(event) {
		var target = $(this).closest('div .media').find('img');
		var urlImg = URL.createObjectURL(event.target.files[0]);
		target.attr('src', urlImg);
	});

	$('#add-img').click(function() {
		var template = Handlebars.compile($("#box-img").html());
		var endTemplate = template();
		var amount = $("#number-row").val();
		for(var i = 1; i <= amount; i++) {
			$("#container-img").append(endTemplate);
		}
		definingRow();
	});
</script>
<script id="box-img" type="text/x-handlebars-template">
	<div class="media col-md-6 mb-2">
		<div class="media-left pr-3">
			<label class="number"></label>
			<img src="{{ asset('img/thumbnail.jpg') }}" class="img-fluid rounded" id="img-cover" alt="none" style="height: 140px;width: 130px;">
			<br>
			<label class="px-2 dropzone bg-white font-weight-bold text-center float-right" style="vertical-align: top; width: 130px;">Gambar Baru</label>
		</div>
		<div class="media-body" style="height: 90px;">
			<input type="hidden" name="_idImage[]">
			<input type="file" name="image[]" class="dropzone w-100 {{ ($errors->has('image'))? 'border-danger' : '' }}" data-toggle="input-file" accept="image/*" required>
			<div class="mt-2">
				<button type="button" class="btn btn-danger btn-sm float-right btn-delete"><i class="fa fa-close"></i></button>
				<button type="button" class="w-25 mx-1 btn btn-warning btn-sm btn-add-after float-right"><i class="fa fa-plus"></i> After</button>
			</div>
		</div>
	</div>
</script>
@endsection