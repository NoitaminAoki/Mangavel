@extends('template.main')

@section('title') MangaVel | Manga  @endsection

@section('header')
<link href="{{asset('templates/css/lib/toastr/toastr.min.css')}}" rel="stylesheet">
@endsection

@section ('body_title') List manga @endsection

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="card-title text-center">List Manga</div>
				<div class="card-subtitle text-center">lorem ipsum dolor set amet</div>
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Cover</th>
								<th>Judul</th>
								<th>Tanggal Dibuat</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($manga as $key => $value)
							<tr>
								<td>{{ ($key+1) }}</td>
								<td style="width: 80px;"><img src="{{ asset('img/admin/manga/'.$value->image) }}" style="width: 80px; height: 80px;"></td>
								<td>{{ $value->judul }}</td>
								<td>{{ date_format(date_create($value->createdAt), "d F Y") }}</td>
								<td style="width: 180px;">
									<a href="{{ route('manga-edit', ['id' => $value->_id]) }}" class="btn btn-warning"><i class="fa fa-edit"></i>Edit</a>
									<a href="{{ route('manga-delete', ['id' => $value->_id]) }}" onclick="return confirm('are you sure?')" class="btn btn-danger"><i class="fa fa-trash"></i>Delete</a>
								</td>
							</tr>
							@endforeach
							@if (empty($manga))
								<tr>
									<td class="text-center" colspan="5"><small class="font-weight-bold">Empty Set(0)</small></td>
								</tr>
							@endif
						</tbody>
					</table>
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