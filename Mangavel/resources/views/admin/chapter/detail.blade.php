@extends('template.main')

@section('title') MangaVel | Chapter Manga - {{ $data->manga->judul }}  @endsection

@section('header')
<link href="{{asset('templates/css/lib/toastr/toastr.min.css')}}" rel="stylesheet">
@endsection

@section ('body_title') Chapter Manga @endsection

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card card-outline-primary">
			<div class="card-body">
				<div class="card-title text-center">List Chapter</div>
				<div class="card-subtitle text-center">lorem ipsum dolor set amet</div>
				<div class="row mx-0">
					<div class="col-md-3 my-2">
						<img src="{{ asset('img/admin/manga/'.$data->manga->image) }}" class="rounded w-100" style="height: 350px">
					</div>
					<div class="col-md-9 my-2">
						<div class="w-100 rounded-top text-center mb-2 bg-custom-2" style="height: 40px;"><h4 class=" font-weight-bold pt-2 text-light">Informasi</h4></div>
						<div class="w-100 px-2">
							<dl>
								<dt>Judul</dt>
								<dd class="list-icons">{{ $data->manga->judul }}</dd>
								<dt>Sinopsis</dt>
								<dd class="list-icons text-justify">{{ $data->manga->sinopsis }}</dd>
							</dl>
						</div>
					</div>
					<div class="col-12 m-t-15">
						<h3 class="card-title m-t-15">{{ $data->manga->judul }} Chapters</h3>
						<hr>
						@foreach ($data->chapter as $key => $value)
						<div class="card bg-custom-3">
							<div class="row mx-0" style="display: inline;">
								<label class="col-10">{{ $data->manga->judul." ".sprintf('%02d', $value->nomor) }} : <i>{{ $value->judul }}</i></label>
								<div class="float-right">
									<a href="{{ route('chapter-edit', $value->_id) }}" class=" ml-2 btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
									<a href="{{ route('chapter-delete', $value->_id) }}" class=" ml-2 btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
								</div>
								<div class="float-right">{{ date_format(date_create($value->createdAt), "d M. Y") }}</div>

							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('footer')
<script src="{{asset('templates/js/lib/toastr/toastr.min.js')}}"></script>
<script src="{{asset('templates/js/custom/toastr.custom.js')}}"></script>

@endsection