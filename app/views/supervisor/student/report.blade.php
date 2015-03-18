@extends('supervisor/student/layout')

@section('pageTitle')
	{{ (strtolower(substr(trim($data['name']),-1))=='s')?$data['name']."'":$data['name']."'s" }} Final Report
@stop

@section('report.nav') selected="selected" @stop
@section('report.menu') active @stop

@section('content')
    <h2>{{ (strtolower(substr(trim($data['name']),-1))=='s')?$data['name']."'":$data['name']."'s" }} Final Report</h2>
  <form class="form-horizontal">
    <div class="alert">
		<b>Mahasiswa Belum Mengupload Final Report.</b>
	</div>
	<div class="well">
		<a href="#">Download Final Report</a>
	</div>
  </form>
@stop