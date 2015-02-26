@extends('student/layout')

@section('pageTitle')
	Code
@stop

@section('code.nav') selected="selected" @stop
@section('code.menu') active @stop

@if($data['status']==1)
@section('addResource')
<script>
function inputCode(button){
	var code=document.input.kode.value;
	var error="";
	if(code=="")
		error="Kode tidak boleh kosong";
	else if(!/^[A-Za-z0-9]{5}$/.test(code))
		error="Wrong code";
	if(error==""){
		var model={
			"code":code
		};
		$.ajax({  
			type: 'POST',  
			url: '<?php echo URL::to('/'); ?>/student/code/save',  
			data: JSON.stringify(model),  
			dataType: 'text',  
			contentType: 'application/json',
			success: function(data){
				$(button).prop("disabled",false);
				if(data==1){
					$("#notifMsg").hide();
					$("#notifMsg").attr("class", "alert alert-success");
					$("#notifMsg").html("Input success");
					$("#notifMsg").slideDown();
					setTimeout(function(){ window.location.href="{{ URL::to('/student/home') }}"; },500);
				}else if(data==0){
					$("#notifMsg").hide();
					$("#notifMsg").attr("class", "alert alert-error");
					$("#notifMsg").html("Wrong code");
					$("#notifMsg").slideDown();
				}else{
					$("#notifMsg").hide();
					$("#notifMsg").attr("class", "alert alert-error");
					$("#notifMsg").html("Internal server error");
					$("#notifMsg").slideDown();
				}
			},  
			error: function(req, status, ex) {
				$(button).prop("disabled",false);
				$("#notifMsg").hide();
				$("#notifMsg").attr("class", "alert alert-error");
				$("#notifMsg").html("Internal Server Error");
				$("#notifMsg").slideDown();
			},  
			timeout:60000  
		});
	}else{
		$("#notifMsg").hide();
		$("#notifMsg").attr("class", "alert alert-error");
		$("#notifMsg").html(error);
		$("#notifMsg").slideDown();
	}
}
function notifMsg(){
	$("#notifMsg").slideUp();
}
</script>
@stop
@endif

@section('content')
    <h2>Input Code</h2>
	@if($data['status']==-1)
	<div class="alert"><a href="{{ URL::to('/student/supervisorList') }}">Anda belum memilih supervisor</a></div>
	@elseif($data['status']==0)
	<div class="alert">Permintaan anda belum direspon supervisor.</div>
	@elseif($data['status']>1)
	<div class="alert">Anda sudah tidak dapat menginput kode lagi.</div>
	@else
	<div class="alert alert-error" id="notifMsg" style="display:none" onclick="notifMsg()"></div>
  <form class="form-horizontal" name="input">
    <fieldset>
    <div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="kode">Kode</label>
          <div class="controls">
            <input type="text" name="kode" id="kode" class="input-xlarge" maxlength="5">
            <p class="help-block">Kode yang diberikan dosen</p>
          </div>
        </div>

    <div class="control-group">
          <!-- Button -->
          <div class="controls">
            <input type="button" class="btn btn-success" onclick="inputCode(this)" value="Masukkan"/>
          </div>
        </div>

    </fieldset>
  </form>
  @endif
@stop