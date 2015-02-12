@extends('supervisor/layout')

@section('pageTitle')
	Edit Profile
@stop

@section('profile.nav') selected="selected" @stop
@section('profile.menu') active @stop

@section('addResource')
	<script>
		$(document.edit.fieldName).typeahead({
			source: function(query, process){
				return $.ajax({  
					type: 'GET',  
					url: '<?php echo URL::to('/'); ?>/field/get/'+query,
					contentType: 'application/json',
					success: function(data){
						var output=JSON.parse(data);
						var field=[];
						for(var i=0;i<output.length;i++)
							field[i]=output[i]._id;
						return process(field);
					},  
					timeout:60000  
				});
			},
			items: 4,
			updater: function(item){
				var fields=document.edit.elements["field[]"];
				var newField=true;
				if(fields!=undefined){
					if(fields.length==undefined){
						if(fields.value==item)
							newField=false;
					}
					else{
						for(var i=0;i<fields.length;i++){
							if(fields[i].value==item)
								newField=false;
						}
					}
				}
				if(newField==true){
					var appended="<div>";
					appended+="<div class=\"input-prepend\">";
					appended+="<input type=\"hidden\" name=\"field[]\" value=\""+item+"\">";
					appended+="<span class=\"add-on\">"+item+"</span>";
					appended+="</div>";
					appended+="<div class=\"input-append\">";
					appended+="<span class=\"add-on\"><a href=\"javascript:void(0)\" onclick=\"delField(this)\"><i class=\"icon-remove\"></i></a></span>";
					appended+="</div>";
					appended+="</div>";
					$("#saveField").append(appended);
				}
			}
		});
		function saveProfile(button){
			$(button).prop("disabled",true);
			var alamat=document.edit.alamat.value;
			var hp=document.edit.hp.value;
			var email=document.edit.email.value;
			var fields=document.edit.elements["field[]"];
			var fieldList=[];
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
				if(fields!=undefined){
					if(fields.length==undefined){
						fieldList.push(fields.value);
					}
					else{
						for(var i=0;i<fields.length;i++){
							fieldList.push(fields[i].value);
						}
					}
				}
				model={
					"address":alamat,
					"handphone":hp,
					"email":email,
					"field":fieldList
				};
				$.ajax({  
					type: 'POST',  
					url: '<?php echo URL::to('/'); ?>/supervisor/profile/save',  
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
		function delField(element){
			if(element.tagName=="A")
				element.parentNode.parentNode.parentNode.parentNode.removeChild(element.parentNode.parentNode.parentNode);
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

          <!-- Text input-->
          <label class="control-label" for="fieldName">Field</label>
          <div class="controls">
            <input type="text" name="fieldName" id="fieldName" class="input-xlarge" placeholder="Search Field" autocomplete="off">
          </div>
        </div>
		<div class="control-group clearfix">

          <!-- Text input-->
          <div class="control-label">Selected Field</div>
          <div class="controls" id="saveField">
		  @foreach($data['field'] as $field)
			<div>
				<div class="input-prepend">
					<input type="hidden" name="field[]" value="{{{ $field }}}"><span class="add-on">{{{ $field }}}</span>
				</div><div class="input-append">
					<span class="add-on">
					<a href="javascript:void(0)" onclick="delField(this)"><i class="icon-remove"></i></a>
					</span>
				</div>
			</div>
		  @endforeach
          </div>
        </div>

    <div class="control-group">
          <!-- Button -->
          <div class="controls">
            <input type="button" class="btn btn-success" value="Masukkan" onclick="saveProfile()"/>
			<input type="button" class="btn btn-info" value="Kembali" onclick="window.history.go(-1)"/>
          </div>
        </div>

    </fieldset>
  </form>
@stop