@extends('student/layout')

@section('pageTitle')
	Thesis
@stop

@section('thesis.nav') selected="selected" @stop
@section('thesis.menu') active @stop

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
		function saveThesis(button){
			$(button).prop("disabled",true);
			var topic=document.edit.topic.value;
			var title=document.edit.title.value;
			var description=document.edit.abstract.value;
			var fields=document.edit.elements["field[]"];
			var fieldList=[];
			var error="";
			if(topic==""){
				error+="<li>Topic tidak boleh kosong</li>";
			}
			if(title==""){
				error+="<li>Title tidak boleh kosong</li>";
			}
			if(description==""){
				error+="<li>Abstract tidak boleh kosong</li>";
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
					"topic":topic,
					"title":title,
					"description":description,
					"field":fieldList
				};
				$.ajax({  
					type: 'POST',  
					url: '<?php echo URL::to('/'); ?>/student/thesis/save',  
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
    <h2>Edit Thesis</h2>
	<div class="alert alert-error" id="notifMsg" style="display:none" onclick="notifMsg()"></div>
  <form class="form-horizontal" name="edit">
    <fieldset>
		<div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="topic">Topic</label>
          <div class="controls">
            <input type="text" name="topic" id="topic" class="input-xlarge" value="{{ $data['thesis']['topic'] }}">
          </div>
        </div>
		<div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="title">Title</label>
          <div class="controls">
            <input type="text" name="title" id="title" class="input-xlarge" value="{{ $data['thesis']['title'] }}">
          </div>
        </div>
		<div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="abstract">Abstract</label>
          <div class="controls">
            <textarea type="text" name="abstract" id="abstract" class="input-xlarge">{{ $data['thesis']['description'] }}</textarea>
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
			@foreach($data['thesis']['field'] as $field)
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
            <input type="button" class="btn btn-success" value="Simpan" onclick="saveThesis(this)"/>
			<input type="button" class="btn btn-info" value="Kembali" onclick="window.history.go(-1)"/>
          </div>
        </div>

    </fieldset>
  </form>
@stop