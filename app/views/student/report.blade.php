@extends('student/layout')

@section('pageTitle')
	Final Report
@stop

@section('report.nav') selected="selected" @stop
@section('report.menu') active @stop

@section('addResourceTop')
<link rel="stylesheet" href="{{ URL::to('/') }}/app-css/task.css">
@stop

@section('addResource')
<script src="{{ URL::to('/') }}/javascripts/overlay.js" type="text/javascript"></script>
<script src="{{ URL::to('/') }}/javascripts/task.js" type="text/javascript"></script>
<script src="{{ URL::to('/') }}/javascripts/jquery.form.min.js" type="text/javascript"></script>
<script>
$("#upload").ajaxForm({
	dataType: 'json',
	beforeSubmit: function(a,f,o) {
		var file=document.upload.report;
		if(file.files.length==0){
			return false;
		}
		$(document.upload.submitBtn).prop("disabled",true);
	},
	success: function(data) {
		if(data.code==1){
			$("#notif").attr("class", "alert alert-success closeNotif");
			$("#notif").html("Berhasil");
			displayNotif();
			setTimeout(function(){ window.location.reload(); },500);
		}else{
			$("#notif").attr("class", "alert alert-error closeNotif");
			$("#notif").html("Gagal");
			displayNotif();
		}
		$(document.upload.submitBtn).prop("disabled",false);
	},
	error: function(ex) {
		$("#notif").attr("class", "alert alert-error closeNotif");
		$("#notif").html("Gagal");
		displayNotif();
		$(document.upload.submitBtn).prop("disabled",false);
	}  
});
</script>
@stop

@section('content')
	<div id="overlay" style="display:none"></div>
	<div id="overlayBox" class="offset3 span6" style="display:none">
		<div class="alert alert-success closeNotif" id="notif">
			<center><b></b></center>
		</div>
	</div>
    <h2>Final Report</h2>
	@if($status==3)
	<div class="alert">
	   <b>Anda sudah tidak dapat mengupload lagi.</b>
    </div>
	@elseif($status==4)
	<div class="alert">
	   <b>Anda sudah lulus.</b>
    </div>
	@elseif($open==true)
  <form name="upload" id="upload" class="form-horizontal" action="{{ URL::to('/') }}/student/report/upload" method="POST" enctype="multipart/form-data">
    <fieldset>
    <div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="report">File</label>
          <div class="controls">
            <input type="file" name="report" id="report" class="input-xlarge">
          </div>
        </div>

    <div class="control-group">
          <!-- Button -->
          <div class="controls">
            <input type="submit" name="submitBtn" class="btn btn-success" value="Submit"/>
          </div>
        </div>

    </fieldset>
  </form>
  @else
  <div class="alert">
	<b>Semua task harus diselesaikan sebelum bisa mengakses halaman ini.</b>
  </div>
  @endif
@stop