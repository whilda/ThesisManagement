@extends('student/layout')

@section('pageTitle')
	Cek Plagiasi
@stop

@section('content')
    <h2>Daftar Laporan Akhir</h2>
	<div class="alert alert-error" id="notifMsg" style="display:none" onclick="notifMsg()"></div>
  <div id="blog-posts">
	@if(count($data)!=0)
	@foreach($data as $file)
    <div class="row-fluid blog-post">
      <div class="span12">
        <h4><strong>{{ $file }}</strong> <a class="btn btn-mini" href="{{ URL::to('/') }}/plagiasi/{{ $file }}">Cek Plagiasi</a></h4>
      </div>
    </div>
	@endforeach
	@endif
	
</div>
@stop