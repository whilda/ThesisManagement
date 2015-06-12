@extends('student/layout')

@section('pageTitle')
	{{ $task['name'] }}
@stop

@section('task.nav') selected="selected" @stop
@section('task.menu') active @stop

@section('addResourceTop')
<style>
.comment-header{
	border-bottom: 2px dotted #6F3A3A;
}
</style>
<link rel="stylesheet" href="{{ URL::to('/') }}/app-css/task.css">
@stop

@section('addResource')
<style>
.alert.comment {
  padding: 8px 35px 8px 14px;
  margin-bottom: 20px;
  text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
  background: #fcf8e3;
  border: 1px solid #fbeed5;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
}
.alert, .alert h4 {
  color: #c09853;
}
.alert.alert-info.comment {
  background: #d9edf7;
  border-color: #bce8f1;
  color: #3a87ad;
}
.alert.alert-danger.comment, .alert.alert-error.comment {
  background: #f2dede;
  border-color: #eed3d7;
  color: #b94a48;
  text-shadow:0 1px 0 rgba(255, 255, 255, 0.5);;
}
.alert.alert-success.comment {
  background: #dff0d8;
  border-color: #d6e9c6;
  color: #468847;
}

</style>
<script src="{{ URL::to('/') }}/javascripts/overlay.js" type="text/javascript"></script>
<script src="{{ URL::to('/') }}/javascripts/task.js" type="text/javascript"></script>
<script src="{{ URL::to('/') }}/javascripts/jquery.form.min.js" type="text/javascript"></script>
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
$("#work").ajaxForm({
	dataType: 'json',
	beforeSubmit: function(a,f,o) {
		var file=document.work.elements["file[]"];
		if(file.files.length>0){
		}else{
			return false;
		}
		$(document.work.submitBtn).prop("disabled",true);
	},
	success: function(data) {
		if(data.code==1){
			$("#notif").attr("class", "alert alert-success closeNotif");
			$("#notif").html("Sukses menambah file");
			displayNotif();
			setTimeout(function(){ window.location.reload(); },500);
		}else{
			$("#notif").attr("class", "alert alert-error closeNotif");
			$("#notif").html("Gagal menambah file");
			displayNotif();
		}
		$(document.work.submitBtn).prop("disabled",false);
	},
	error: function(ex) {
		$("#notif").attr("class", "alert alert-error closeNotif");
		$("#notif").html("Gagal menambah file");
		displayNotif();
		$(document.work.submitBtn).prop("disabled",false);
	}  
});
$("#comment").ajaxForm({
	dataType: 'json',
	beforeSubmit: function(a,f,o) {
		var text=document.comment.text.value;
		var error="";
		if(text==""){
			error+="Mohon isi text sebelum menambah komentar.";
		}
		if(error!=""){
			$("#notif").attr("class", "alert alert-error closeNotif");
			$("#notif").html(error);
			displayNotif();
			return false;
		}
		$(document.comment.submitBtn).prop("disabled",true);
	},
	success: function(data) {
		if(data.code==1){
			$("#notif").attr("class", "alert alert-success closeNotif");
			$("#notif").html("Sukses menambah komentar");
			displayNotif();
			setTimeout(function(){ window.location.reload(); },500);
		}else{
			$("#notif").attr("class", "alert alert-error closeNotif");
			$("#notif").html("Gagal menambah komentar");
			displayNotif();
		}
		$(document.comment.submitBtn).prop("disabled",false);
	},
	error: function(ex) {
		$("#notif").attr("class", "alert alert-error closeNotif");
		$("#notif").html("Gagal menambah komentar");
		displayNotif();
		$(document.comment.submitBtn).prop("disabled",false);
	}  
});
</script>
@stop

@section('content')
	<br/>
	<div id="overlay" style="display:none"></div>
	<div id="overlayBox" class="offset3 span6" style="display:none">
		<div class="alert alert-success closeNotif" id="notif">
			<center><b></b></center>
		</div>
	</div>
	<div id="confirm" class="overlayBoxes offset3 span6" style="display:none">
		<div class="alert alert-warning notif">
			<center>
				<b id="confirmText"></b><br/>
				<input type="button" id="confirmYes" class="btn btn-success" value="Ya">
				<input type="button" class="btn btn-info" onclick="cancelConfirm()" value="Tidak">
			</center>
		</div>
	</div>
  <div class="well">
	<h2>{{ $task['name'] }}</h2>
	<table>
		<tbody>
			<tr>
				<td style="min-width:140px">Status :</td>
				<td>{{ ($task['status']==1)?"Done":"Ongoing" }} </td>
			</tr>
			<tr>
			<?php $date=new DateTime($task['created_date']); ?>
				<td>Created Date :</td>
				<td>{{ $date->format('M jS') }}</td>
			</tr>
			<tr>
				<td>End Date :</td>
				<td>{{ ($task['duration']>0)?$date->modify("+".$task['duration']." day")->format('M jS'):"???" }}</td>
			</tr>
		</tbody>
	</table>
	<hr/>
	Description:
	<p>
		{{ $task['description'] }}
	</p>
	File:
	<table class="table">
      <thead>
        <tr>
          <th class="span6">Name</th>
          <th class="span6">Upload Date</th>
        </tr>
      </thead>
       <tbody>
	   @if(count($task['file'])>0)
	   @foreach($task['file'] as $file)
	    <tr>
          <td><a href="{{ URL::to('/download/'.$file['fileid']) }}">{{ $file['filename'] }}</a></td>
          <td>{{ (new DateTime($file['upload_date']))->format("j F Y") }}</td>
        </tr>
		@endforeach
		@else
		<tr><td colspan="2"><center><i>-No Attachment-<i></center></td></tr>
		@endif
       </tbody>
    </table>
	<form name="work" id="work" action="{{ URL::to('/') }}/student/task/{{ $task['id_task'] }}/creatework" method="POST" enctype="multipart/form-data">
		Attachment: <input type="file" name="file[]" multiple /><input name="submitBtn" type="submit" class="btn btn-primary" value="Tambah">
	</form>
  </div>
  <h2>Comments</h2>
  <div class="well">
	<h2 class="comment-header">Tambah Comment</h2>
	<form class="form-horizontal" name="comment" id="comment" action="{{ URL::to('/') }}/student/task/{{ $task['id_task'] }}/comment" method="POST" enctype="multipart/form-data">
		<div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="type">Type</label>
          <div class="controls">
            <select name="type" id="type" class="input-xlarge">
				<option value="21">Comment</option>
				<option value="22">Ask</option>
			</select>
          </div>
        </div>
		<div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="text">Text</label>
          <div class="controls">
            <textarea name="text" id="text" class="input-xxlarge" rows="6" placeholder="Masukkan pesan disini..."></textarea>
          </div>
        </div>
		<div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="file">Attachment</label>
          <div class="controls">
            <input type="file" name="file[]" multiple />
          </div>
        </div>
		<div class="control-group">
          <div class="controls">
            <input name="submitBtn" type="submit" class="btn btn-success" value="Add Comment">
          </div>
        </div>
	</form>
  </div>
  @foreach(array_reverse($task['comment']) as $comment)
  <div class="alert @if($comment['type']=='12'||$comment['type']=='21')
		{{ 'alert-info' }}
	@elseif($comment['type']=='11')
		{{ 'alert-error' }}
	@elseif($comment['type']=='13')
		{{ 'alert-success' }}
	@elseif($comment['type']=='22')
		{{ 'alert-block' }} 
	@endif comment">
	<div class="comment-header">@if($comment['type']=='12'||$comment['type']=='21')
		{{ 'Comment' }}
	@elseif($comment['type']=='11')
		{{ 'Instruct' }}
	@elseif($comment['type']=='13')
		{{ 'Clarify' }}
	@elseif($comment['type']=='22')
		{{ 'Ask' }}
	@endif
	by {{ $comment['by'] }} on {{ date_format(new DateTime(),"j F Y") }}</div><br/>
	<p>{{ nl2br(htmlentities($comment['text'])) }}</p>
	@foreach($comment['file'] as $file)
	<div class="span3"><a href="{{ URL::to('/download/'.$file['fileid']) }}"><i class="icon-paper-clip"></i> {{ $file['filename'] }}</a></div>
	@endforeach
	<div class="clearfix"></div>
  </div>
  @endforeach
@stop