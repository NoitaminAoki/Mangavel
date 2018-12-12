@extends('template.main')

@section('title') MangaVel | Beranda  @endsection

@section('header')
<link href="{{asset('templates/css/lib/toastr/toastr.min.css')}}" rel="stylesheet">
@endsection

@section ('body_title') All @endsection

@section('content')
<div class="row">

</div>

@endsection

@section('footer')
<script src="{{asset('templates/js/custom/toastr.custom.js')}}"></script>
<script src="{{asset('templates/js/lib/toastr/toastr.min.js')}}"></script>

@endsection