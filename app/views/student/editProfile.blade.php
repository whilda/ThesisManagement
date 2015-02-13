@extends('student/layout')

@section('pageTitle')
	Edit Profile
@stop

@section('profile.nav') selected="selected" @stop
@section('profile.menu') active @stop

@section('addResource')
	<script>
		function saveProfile(button){
			$(button).prop("disabled",true);
			var alamat=document.edit.alamat.value;
			var hp=document.edit.hp.value;
			var email=document.edit.email.value;
			var error="";
			if(alamat==""){
				error+="<li>Alamat tidak boleh kosong</li>";
			}
			if(hp==""){
				error+="<li>No. Handphone tidak boleh kosong</li>";
			}
			if(email==""){
				error+="<li>Email tidak boleh kosong</li>";
			}
			if(error==""){
				model={
					"address":alamat,
					"handphone":hp,
					"email":email,
				};
				$.ajax({  
					type: 'POST',  
					url: '<?php echo URL::to('/'); ?>/student/profile/save',  
					data: JSON.stringify(model),  
					dataType: 'text',  
					contentType: 'application/json',
					success: function(data){
						$(button).prop("disabled",false);
						if(data==1){
							$("#notifMsg").hide();
							$("#notifMsg").attr("class", "alert alert-success");
							$("#notifMsg").html("Save success");
							$("#notifMsg").slideDown();
						}else{
							$("#notifMsg").hide();
							$("#notifMsg").attr("class", "alert alert-error");
							$("#notifMsg").html("Save failed");
							$("#notifMsg").slideDown();
						}
					},  
					error: function(req, status, ex) {
						$(button).prop("disabled",false);
						$("#notifMsg").hide();
						$("#notifMsg").attr("class", "alert alert-error");
						$("#notifMsg").html("Save failed");
						$("#notifMsg").slideDown();
					},  
					timeout:60000  
				});
			}else{
				$(button).prop("disabled",false);
				$("#notifMsg").hide();
				$("#notifMsg").attr("class", "alert alert-error");
				$("#notifMsg").html("<ul>"+error+"</ul>");
				$("#notifMsg").slideDown();
			}
		}
		function notifMsg(){
			$("#notifMsg").slideUp();
		}
	</script>
@stop

@section('content')
    <h2>Edit Profile</h2>
	<div class="alert alert-error" id="notifMsg" style="display:none" onclick="notifMsg()"></div>
  <form class="form-horizontal" name="edit">
    <fieldset>
		<div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="alamat">Alamat</label>
          <div class="controls">
            <textarea name="alamat" id="alamat" class="input-xlarge">{{ $data['address'] }}</textarea>
          </div>
        </div>
		<div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="hp">No. Handphone</label>
          <div class="controls">
            <input type="text" name="hp" id="hp" class="input-xlarge" value="{{ $data['handphone'] }}">
          </div>
        </div>
		<div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="email">Email</label>
          <div class="controls">
            <input type="text" name="email" id="email" class="input-xlarge" value="{{ $data['email'] }}">
          </div>
        </div>

    <div class="control-group">
          <!-- Button -->
          <div class="controls">
            <input type="button" class="btn btn-success" value="Simpan" onclick="saveProfile(this)"/>
			<input type="button" class="btn btn-info" value="Kembali" onclick="window.history.go(-1)"/>
          </div>
        </div>

    </fieldset>
  </form>
@stop