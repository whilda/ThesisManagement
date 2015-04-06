@extends('student/layout')

@section('pageTitle')
	Edit Profile
@stop

@section('profile.nav') selected="selected" @stop
@section('profile.menu') active @stop

@section('addResource')
	<script>
		function savePass(button){
			$(button).prop("disabled",true);
			var old=document.edit.old.value;
			var newp=document.edit.new.value;
			var renewp=document.edit.renew.value;
			var error="";
			if(old==""){
				error+="<li>Password lama tidak boleh kosong</li>";
			}
			if(newp==""){
				error+="<li>Password baru tidak boleh kosong</li>";
			}else if(!/^[\w]{8,16}$/.test(old)){
				error+="<li>Password harus diantara 8-16 digit, gunakan kombinasi huruf dan angka.</li>"
			}
			if(renewp!=newp){
				error+="<li>Kolom ulang password baru tidak sama</li>";
			}
			if(old==newp){
				error+="<li>Password lama dan baru tidak boleh sama</li>";
			}
			if(error==""){
				model={
					"oldpass":old,
					"newpass":newp,
					"renewpass":renewp,
				};
				$.ajax({  
					type: 'POST',  
					url: '<?php echo URL::to('/'); ?>/password/save',  
					data: JSON.stringify(model),  
					dataType: 'text',  
					contentType: 'application/json',
					success: function(data){
						$(button).prop("disabled",false);
						try{
							data=JSON.parse(data);
							if(data.code==1){
								$("#notifMsg").hide();
								$("#notifMsg").attr("class", "alert alert-success");
								$("#notifMsg").html("Change password success");
								$("#notifMsg").slideDown();
								setTimeout(function(){ window.location.href="{{ URL::to('/student/profile') }}"; },500);
							}else{
								$("#notifMsg").hide();
								$("#notifMsg").attr("class", "alert alert-error");
								$("#notifMsg").html("Change password failed");
								$("#notifMsg").slideDown();
							}
						}catch(e){
							$("#notifMsg").hide();
							$("#notifMsg").attr("class", "alert alert-error");
							$("#notifMsg").html("Change password failed");
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
          <label class="control-label" for="old">Password Lama</label>
          <div class="controls">
            <input type="password" name="old" id="old" class="input-xlarge"/>
          </div>
        </div>
		<div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="new">Password Baru</label>
          <div class="controls">
            <input type="password" name="new" id="new" class="input-xlarge"/>
          </div>
        </div>
		<div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="renew">Ulangi Password Baru</label>
          <div class="controls">
            <input type="password" name="renew" id="renew" class="input-xlarge"/>
          </div>
        </div>

    <div class="control-group">
          <!-- Button -->
          <div class="controls">
            <input type="button" class="btn btn-success" value="Ubah" onclick="savePass(this)"/>
			<input type="button" class="btn btn-info" value="Kembali" onclick="window.history.go(-1)"/>
          </div>
        </div>

    </fieldset>
  </form>
@stop