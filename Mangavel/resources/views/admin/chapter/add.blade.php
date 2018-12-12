@extends('template.main')

@section('title') MangaVel | Tambah Chapter  @endsection

@section('header')
<link href="{{asset('templates/css/lib/toastr/toastr.min.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('lib/select2/css/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('lib/select2/css/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('js/jquery-ui.min.css') }}">
@endsection

@section ('body_title') Tambah Chapter @endsection

@section('content')

<form method="POST" class="col-12" action="{{ route('chapter-save') }}"  enctype="multipart/form-data">
	<div class="row" id="page-one">
		@csrf
		<div class="col-12">
			<div class="card">
				<h3 class="font-weight-bold text-center col-12">MANGA</h3>
				<div class="form-group col-12">
					<label>Pilih Manga</label>
					<select class="form-control select2" name="manga" style="width: 100%;" required>
						<optgroup label="Pilih Manga"></optgroup>
						@foreach ($manga as $value)
						<option value="{{ $value->_id }}">{{ $value->judul }}</option>
						@endforeach
					</select>
				</div>
				<h3 class="font-weight-bold text-center col-12 mt-5">CHAPTER</h3>
				<div class="row mx-0">
					<div class="form-group col-md-6">
						<label>Judul</label>
						<input type="text" name="judul" class="form-control" autocomplete="off" required>
					</div>
					<div class="form-group col-md-6">
						<label>Chapter ke-</label>
						<input type="text" id="chapter" name="nomor" class="form-control" autocomplete="off" required>
					</div>
					<div class="form-group col-md-6">
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
					<div class="form-group col-md-6">
						<label>Multiple Image</label>
						<br>
						<div class="col-md-8 px-0">
							<input type="file" id="input-multiple" name="image[]" class="dropzone w-100" multiple>
						</div>
					</div>
					<div id="container-img-multiple" class="col-12 row mx-0">
						
					</div>
					<div id="container-img" class="col-12">
						{{-- <div class="media col-md-6 mb-2">
							<div class="media-left pr-3">
								<label class="number">1). </label>
								<img src="{{ asset('img/thumbnail.jpg') }}" class="img-fluid rounded" alt="none" style="height: 140px;width: 130px;">
							</div>
							<div class="media-body" style="height: 90px;">
								<input type="file" name="image[]" class="dropzone w-100 {{ ($errors->has('image'))? 'border-danger' : '' }}" data-toggle="input-file" accept="image/*" required>
								<div class="mt-2">
									<button type="button" class="btn btn-danger btn-sm float-right btn-delete"><i class="fa fa-close"></i></button>
									<button type="button" class="w-25 mx-1 btn btn-warning btn-sm btn-add-after float-right"><i class="fa fa-plus"></i> After</button>
								</div>
							</div>
						</div> --}}
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
						<button type="submit" id="btn-back" class="btn btn-primary float-right" style="width: 100px;">Submit</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>

@endsection

@section('footer')
<script src="{{asset('templates/js/lib/toastr/toastr.min.js')}}"></script>
<script src="{{asset('templates/js/custom/toastr.custom.js')}}"></script>
<script src="{{ asset('lib/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/handlebars-v4.0.12.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$(".select2").select2({
			placeholder: "Pilih manga",
			theme: "bootstrap4"
		});
		$(".select2").val(1).trigger('change.select2');
	});

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
		$("#container-img-multiple").children("div").remove();
		container.after(endTemplate);
		definingRow();
	});

	$(document).on("click", ".btn-delete", function() {
		$(this).closest('div .media').remove();
		definingRow();
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
		$("#container-img-multiple").children("div").remove();
		for(var i = 1; i <= amount; i++) {
			$("#container-img").append(endTemplate);
		}
		definingRow();
	});

	var inputFileMultiple = document.getElementById("input-multiple");

	inputFileMultiple.onchange = function(e) {
		var allFiles = e.target.files;
		var template = Handlebars.compile($("#img-multiple").html());
		var data = {};
		var number = 1;
		$("#container-img").children("div .media").remove();
		$("#container-img-multiple").children("div").remove();
		for(var i = 0; i < allFiles.length; i++){
			data = {
				urlImg: URL.createObjectURL(allFiles[i]),
				number: number++
				}
			var endTemplate = template(data);
			$("#container-img-multiple").append(endTemplate);
		}
		console.log(allFiles, allFiles.length);
	};


	// $("#btn-next").on('click', function() {
	// 	$("#page-one").hide("slide", 600);
	// 	setTimeout(function() {
	// 		$("#page-two").show("slide", 600);
	// 	}, 1000);
	// });

	// $("#btn-back").on('click', function() {
	// 	$("#page-two").hide("slide", 600);
	// 	setTimeout(function() {
	// 		$("#page-one").show("slide", 600);
	// 	}, 1000);
	// });

	function show() {
		$("#div-info-body").show("fade", 1000);
		setTimeout(function() {
			$("#div-info-body").hide("fade", 1000);
		}, 2000);
	}

</script>
<script id="img-multiple" type="text/x-handlebars-template">
	<div class="col-md-4 col-sm-6 mb-2"><img src="@{{ urlImg }}" class="img-fluid rounded border" alt="none" style="height: 230px;width: 210px; box-shadow: 0 5px 20px #000;">
		<label class="px-2 dropzone bg-white font-weight-bold text-center" style="vertical-align: top; width: 210px;">Gambar ke-@{{ number }}</label>
	</div>
</script>
<script id="box-img" type="text/x-handlebars-template">
	<div class="media col-md-6 mb-2">
		<div class="media-left pr-3">
			<label class="number"></label>
			<img src="{{ asset('img/thumbnail.jpg') }}" class="img-fluid rounded" id="img-cover" alt="none" style="height: 140px;width: 130px;">
		</div>
		<div class="media-body" style="height: 90px;">
			<input type="file" name="image[]" class="dropzone w-100 {{ ($errors->has('image'))? 'border-danger' : '' }}" data-toggle="input-file" accept="image/*" required>
			<div class="mt-2">
				<button type="button" class="btn btn-danger btn-sm float-right btn-delete"><i class="fa fa-close"></i></button>
				<button type="button" class="w-25 mx-1 btn btn-warning btn-sm btn-add-after float-right"><i class="fa fa-plus"></i> After</button>
			</div>
		</div>
	</div>
</script>
@endsection