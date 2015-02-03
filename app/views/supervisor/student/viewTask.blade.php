@extends('supervisor/student/layout')

@section('pageTitle')
	Final Report
@stop

@section('report.nav') selected="selected" @stop
@section('report.menu') active @stop

@section('addResourceTop')
<style>
.comment-header{
	border-bottom: 2px dotted #6F3A3A;
}
</style>
@stop

@section('addResource')
<script>
	$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	})
</script>
@stop

@section('content')
	<br/>
  <div class="well">
	<div style="position:absolute;right:30px;top:30px;"><a href="#" class="btn btn-info">Edit</a> <a href="#" class="btn btn-info">Delete</a></div>
	<h2>Judul Task</h2>
	<table>
		<tbody>
			<tr>
				<td style="min-width:140px">Status :</td>
				<td>active (<a href="#">Validate</a>)</td>
			</tr>
			<tr>
				<td>Created Date :</td>
				<td>...</td>
			</tr>
			<tr>
				<td>End Date :</td>
				<td>...</td>
			</tr>
		</tbody>
	</table>
	<hr/>
	Description:
	<p>
		deskripsi panjaaaaaaang...
	</p>
	File:
	<table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Upload Date</th>
		  <th style="width:30px">Action</th>
        </tr>
      </thead>
       <tbody>
	    <tr>
          <td><a href="#">asd.jpg</a></td>
          <td>1-1-15</td>
		  <td><a href="#"><i class="icon-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></a></td>
        </tr>
        <tr>
          <td><a href="#">asd.pdf</a></td>
          <td>1-1-15</td>
		  <td><a href="#"><i class="icon-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></a></td>
        </tr>
       </tbody>
    </table>
	<form>
		Tambah File: <input type="file" name="file"/><input type="submit" class="btn btn-primary" value="Tambah">
	</form>
  </div>
  <h2>Comments</h2>
  <div class="well">
	<h2 class="comment-header">Tambah Comment</h2>
	<form class="form-horizontal">
		<div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="type">Type</label>
          <div class="controls">
            <select name="type" id="type" class="input-xlarge">
				<option value="1">Instruct</option>
				<option value="2">Comment</option>
				<option value="3">Clarify</option>
				<option value="3">Ask</option>
			</select>
          </div>
        </div>
		<div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="alamat">Text</label>
          <div class="controls">
            <textarea name="alamat" id="alamat" class="input-xxlarge" rows="6">Komentar</textarea>
          </div>
        </div>
		<div class="control-group">
          <div class="controls">
            <input type="submit" class="btn btn-success" value="Add Comment">
          </div>
        </div>
	</form>
  </div>
  <div class="alert alert-info">
	<div class="comment-header">Comment by Username on 01-01-15</div><br/>
	<p>Komentar panjang....</p>
	<p><a href="#" class="btn"><i class="icon-paper-clip"></i> asd.pdf</a></p>
  </div>
  <div class="alert alert-error">
	<div class="comment-header">Instruction by Username on 01-01-15</div><br/>
	<p>Komentar panjang....</p>
	<p><a href="#" class="btn"><i class="icon-paper-clip"></i> asd.pdf</a></p>
  </div>
  <div class="alert alert-success">
	<div class="comment-header">Clarify by Username on 01-01-15</div><br/>
	<p>Komentar panjang....</p>
	<p><a href="#" class="btn"><i class="icon-paper-clip"></i> asd.pdf</a></p>
  </div>
  <div class="alert alert-block">
	<div class="comment-header">Ask by Username on 01-01-15</div><br/>
	<p>Komentar panjang....</p>
	<p><a href="#" class="btn"><i class="icon-paper-clip"></i> asd.pdf</a></p>
  </div>
@stop