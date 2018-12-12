@extends('template.main')

@section('title') MangaVel | Chapter  @endsection

@section('header')
<link href="{{asset('templates/css/lib/toastr/toastr.min.css')}}" rel="stylesheet">
@endsection

@section ('body_title') List Chapter @endsection

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="card-title text-center">List Chapter</div>
				<div class="card-subtitle text-center">lorem ipsum dolor set amet</div>
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Cover</th>
								<th>Judul</th>
								<th>Jumlah Chapter</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($chapter as $key => $value)
							<tr>
								<td>{{ ($key+1) }}</td>
								<td style="width: 80px;"><img src="{{ asset('img/admin/manga/'.$value->_id->image) }}" class="rounded" style="width: 80px; height: 80px;"></td>
								<td>{{ $value->_id->judul }}</td>
								<td>{{ $value->total }}</td>
								<td style="width: 180px;">
									<a href="{{ route('chapter-view', $value->_id->_id) }}" class="btn btn-success">More <i class="fa fa-plus"></i></a>
								</td>
							</tr>
							@endforeach
							@if (empty($chapter))
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