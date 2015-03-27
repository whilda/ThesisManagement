@extends('supervisor/student/layout')

@section('pageTitle')
	{{ (strtolower(substr(trim($data['name']),-1))=='s')?$data['name']."'":$data['name']."'s" }} Final Report
@stop

@section('report.nav') selected="selected" @stop
@section('report.menu') active @stop

@section('content')
    <h2>{{ (strtolower(substr(trim($data['name']),-1))=='s')?$data['name']."'":$data['name']."'s" }} Final Report</h2>
  <form class="form-horizontal">
	@if($data['status']==4)
	<div class="alert">
		<b>Mahasiswa ini sudah lulus.</b>
	</div>
	@elseif(!$isSupervisor)
	<div class="alert">
		<b>Anda tidak dapat melihat Final report mahasiswa ini.</b>
	</div>
	@elseif($report=="")
    <div class="alert">
		<b>Mahasiswa Belum Mengupload Final Report.</b>
	</div>
	@else
	<div class="well">
		<a href="{{ URL::to('/download/'.$report['fileid']) }}">Download Final Report</a>
	</div>
	<a href="{{ URL::to('/student/'.$data['_id'].'/report/approve') }}" class="btn">Approve</a> <a href="{{ URL::to('/student/'.$data['_id'].'/report/reject') }}" class="btn">Reject</a>
	@endif
  </form>
@stop