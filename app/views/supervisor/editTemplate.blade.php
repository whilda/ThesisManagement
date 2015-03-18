@extends('supervisor/layout')

@section('pageTitle')
	Task Template
@stop

@section('addResourceTop')
<link rel="stylesheet" href="{{ URL::to('/') }}/app-css/task.css">
@stop

@section('addResource')
<script src="{{ URL::to('/') }}/javascripts/overlay.js" type="text/javascript"></script>
<script src="{{ URL::to('/') }}/javascripts/task.js" type="text/javascript"></script>
<script src="{{ URL::to('/') }}/javascripts/jquery.form.min.js" type="text/javascript"></script>
<script>
var type;
var taskElement=[];
$(document.task.duration).on("keydown",function(e){
	// Allow: backspace, delete, tab, escape, enter and .
	if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
		 // Allow: Ctrl+A
		(e.keyCode == 65 && e.ctrlKey === true) || 
		 // Allow: home, end, left, right
		(e.keyCode >= 35 && e.keyCode <= 39)) {
			 // let it happen, don't do anything
			 return;
	}
	// Ensure that it is a number and stop the keypress
	if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
		e.preventDefault();
	}
})
$("#task").ajaxForm({
	dataType: 'json',
	beforeSubmit: function(a,f,o) {
		var name=document.task.name.value;
		var description=document.task.description.value;
		var duration=document.task.duration.value;
		var error="";
		if(name==""){
			error+="<li>Name tidak boleh kosong</li>";
		}
		if(description==""){
			error+="<li>Description tidak boleh kosong</li>";
		}
		if(duration!=""&&(isNaN(duration)||duration<0)){
			error+="<li>Duration harus berbentuk angka dan &gt0</li>";
		}
		if(error!=""){
			$("#notif").attr("class", "alert alert-error closeNotif");
			$("#notif").html("<ul>"+error+"</ul>");
			displayNotif();
			return false;
		}
		$(document.task.simpan).prop("disabled",true);
		$(document.task.batal).prop("disabled",true);
	},
	success: function(data) {
		if(type==1){
			if(data.code==1){
				$("#notif").attr("class", "alert alert-success closeNotif");
				$("#notif").html("Sukses menambah task");
				displayNotif();
			}else{
				$("#notif").attr("class", "alert alert-error closeNotif");
				$("#notif").html("Gagal menambah task");
				displayNotif();
			}
		}else if(type==2){
			if(data.code==1){
				$("#notif").attr("class", "alert alert-success closeNotif");
				$("#notif").html("Sukses merubah task");
				displayNotif();
			}else{
				$("#notif").attr("class", "alert alert-error closeNotif");
				$("#notif").html("Gagal merubah task");
				displayNotif();
			}
		}
		reloadTask();
		$(document.task.simpan).prop("disabled",false);
		$(document.task.batal).prop("disabled",false);
		$("#tasks").slideToggle();
	},
	error: function(ex) {
		$("#notif").attr("class", "alert alert-error closeNotif");
		if(type==1)
			$("#notif").html("Gagal menambah task");
		else if(type==2)
			$("#notif").html("Gagal merubah task");
		displayNotif();
		$(document.task.simpan).prop("disabled",false);
		$(document.task.batal).prop("disabled",false);
		$("#tasks").slideToggle();
	}  
});
function tambahTask(){
	type=1;
	$('#judulTipe').html("Tambah Task");
	document.task.name.value="";
	document.task.description.value="";
	$(document.task).prop("action","{{ URL::to('/supervisor/template/'.$data['code'].'/task/add') }}");
	document.task.duration.value="";
	$('#fileContainer').html("");
	$('#delFile').html("");
	var file = $("#file");
	file.replaceWith(file.val('').clone(true));
	$("#tasks").slideToggle();
}
function showTask(){
	var tambah="";
	for(var i=0;i<taskElement.length;i++){
		tambah+="<div><div class=\"input-prepend\"><span class=\"add-on\">"+taskElement[i].name+"</span>";
		tambah+="</div><div class=\"input-append\">";
		tambah+="<span class=\"add-on\"><a href=\"javascript:void(0)\" onclick=\"editTask(this)\" taskName=\""+taskElement[i].name+"\"><i class=\"icon-pencil\"></i></a></span>";
		tambah+="</div><div class=\"input-append\">";
		tambah+="<span class=\"add-on\"><a href=\"javascript:void(0)\" onclick=\"confirmDelTask(this)\" taskName=\""+taskElement[i].name+"\"><i class=\"icon-remove\"></i></a></span></div>";
		tambah+="</div>";
	}
	$("#taskLists").html(tambah);
}
function reloadTask(){
	$("#taskLists").html("<img class=\"loading\" alt=\"loading\" src=\"{{ URL::to('/') }}/images/loading-icons/loading11.gif\">");
	$.ajax({  
		type: 'GET',  
		url: '<?php echo URL::to('/'); ?>/supervisor/template/{{ $data['code'] }}/tasks',
		contentType: 'application/json',
		success: function(data){
			try{
				taskElement=JSON.parse(data);
				showTask();
			}catch(err){
				alert(err);
			}
		},  
		error: function(ex) {
			$("#notif").attr("class", "alert alert-error closeNotif");
			$("#notif").html("Koneksi error");
			displayNotif();
		},  
		timeout:60000  
	});
}
reloadTask();
function searchTask(name){
	for(var i=0;i<taskElement.length;i++){
		if(taskElement[i].name==name)
			return taskElement[i];
	}
	return "";
}
function editTask(data){
	type=2;
	var taskName=data.getAttribute("taskName");
	if(taskName!=""){
		var task=searchTask(taskName);
		if(task!=""){
			$('#judulTipe').html("Edit Task");
			document.task.name.value=task.name;
			document.task.description.value=task.description;
			$(document.task).prop("action","{{ URL::to('/supervisor/template/'.$data['code'].'/task') }}/"+task.name+"/edit");
			document.task.duration.value=task.duration;
			$('#fileContainer').html("");
			$('#delFile').html("");
			for(var i=0;i<task.file.length;i++){
				var element=document.createElement("div");
				var child1=document.createElement("div");
				child1.className="input-prepend";
				$(child1).html("<span class=\"add-on\">"+task.file[i].filename+"</span>");
				var child2=document.createElement("div");
				child2.className="input-append";
				$(child2).html("<span class=\"add-on\"><a href=\"javascript:void(0)\" fileID=\""+task.file[i].fileid+"\" onclick=\"confirmDelFile(this)\"><i class=\"icon-remove\"></i></a></span>");
				$(element).append(child1,child2);
				$("#fileContainer").append(element);
			}
			var file = $("#file");
			file.replaceWith(file.val('').clone(true));
			$("#tasks").slideToggle();
		}
	}
}
function delTask(){
	var taskName=data.getAttribute("taskName");
	if(taskName!=""){
		$.ajax({  
			type: 'GET',  
			url: "{{ URL::to('/supervisor/template/'.$data['code'].'/task') }}/"+taskName+"/delete",
			contentType: 'application/json',
			success: function(data){
				try{
					data=JSON.parse(data);
					if(data.code==1){
						$("#notif").attr("class", "alert alert-success closeNotif");
						$("#notif").html("Sukses menghapus task");
						displayNotif();
						reloadTask();
					}else{
						$("#notif").attr("class", "alert alert-error closeNotif");
						$("#notif").html("Gagal menghapus task");
						displayNotif();
					}
				}catch(err){
					$("#notif").attr("class", "alert alert-error closeNotif");
					$("#notif").html("Gagal menghapus task");
					displayNotif();
				}
			},  
			error: function(ex) {
				$("#notif").attr("class", "alert alert-error closeNotif");
				$("#notif").html("Gagal menghapus task");
				displayNotif();
			},  
			timeout:60000  
		});
		cancelConfirm();
	}
}
function saveTemplate(button){
	var name=document.template.name.value;
	var description=document.template.description.value;
	var found=false;
	var error="";
	$(button).prop("disabled",true);
	if(name==""){
		error+="<li>Name tidak boleh kosong</li>";
	}
	if(description==""){
		error+="<li>Description tidak boleh kosong</li>";
	}
	if(error==""){
		var model={
			"name":name,
			"description":description,
		}
		$.ajax({  
			type: 'POST',  
			url: '<?php echo URL::to('/'); ?>/supervisor/template/{{ $data['code'] }}/save',
			data: JSON.stringify(model),  
			dataType: 'text',
			contentType: 'application/json',
			success: function(data){
				$(button).prop("disabled",false);
				try{
					var output=JSON.parse(data);
					if(output.code==1){
						$("#notif").attr("class", "alert alert-success closeNotif");
						$("#notif").html("Sukses menyimpan template");
						displayNotif();
					}else{
						$("#notif").attr("class", "alert alert-error closeNotif");
						$("#notif").html("Gagal menyimpan template");
						displayNotif();
					}
				}catch(err){
					$("#notif").attr("class", "alert alert-error closeNotif");
					$("#notif").html("Gagal menyimpan template");
					displayNotif();
				}
			},  
			error: function(ex) {
				$("#notif").attr("class", "alert alert-error closeNotif");
				$("#notif").html("Gagal menyimpan template");
				displayNotif();
			},  
			timeout:60000  
		});
	}
	else{
		$("#notif").attr("class", "alert alert-error closeNotif");
		$("#notif").html("<ul>"+error+"</ul>");
		displayNotif();
	}
}
</script>
@stop

@section('template.nav') selected="selected" @stop
@section('template.menu') active @stop

@section('content')
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
	<div id="tasks" style="display:none">
		<h2 id="judulTipe"></h2>
		<form class="form-horizontal overlay-content" name="task" id="task" action="" method="POST" enctype="multipart/form-data">
			<fieldset>
				<div class="control-group">

				  <!-- Text input-->
				  <label class="control-label" for="name">Name</label>
				  <div class="controls">
					<input type="text" name="name" id="name" class="input-xlarge" value="Nama task">
				  </div>
				</div>
				<div class="control-group">

				  <!-- Text input-->
				  <label class="control-label" for="description">Description</label>
				  <div class="controls">
					<textarea name="description" id="description" class="input-xlarge"></textarea>
				  </div>
				</div>
				<div class="control-group">

				  <!-- Text input-->
				  <label class="control-label" for="duration">Duration</label>
				  <div class="controls">
					<input type="text" maxlength="3" name="duration" id="duration" class="input-small"> hari
				  </div>
				</div>
				<div class="control-group">

				  <!-- Text input-->
				  <div class="control-label">Files</div>
				  <div id="delFile"></div>
				  <div class="controls" id="fileContainer">
					<div>
						<div class="input-prepend">
							<span class="add-on">asd.png</span>
						</div><div class="input-append">
							<span class="add-on"><a href="javascript:void(0)" taskFile="1" onclick="confirmDelFile(this)"><i class="icon-remove"></i></a></span>
						</div>
					</div>
					<div>
						<div class="input-prepend">
							<span class="add-on">def.pdf</span>
						</div><div class="input-append">
							<span class="add-on"><a href="javascript:void(0)" taskFile="2" onclick="confirmDelFile(this)"><i class="icon-remove"></i></a></span>
						</div>
					</div>
				  </div>
				</div>
				<div class="control-group">

				  <!-- Text input-->
				  <label class="control-label" for="file">File</label>
				  <div class="controls">
					<input type="file" name="file[]" id="file" class="input-xlarge" multiple>
				  </div>
				</div>
				<div class="control-group">

				  <!-- Text input-->
				  <div class="controls">
					<input type="submit" class="btn btn-success" name="simpan" value="Simpan"> <input type="button" class="btn closeBtn" name="batal" value="Batal">
				  </div>
				</div>
				
			</fieldset>
		</form>
	</div>
    <h2>Edit Template</h2>
  <form class="form-horizontal" name="template">
    <fieldset>
		<div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="name">Name</label>
          <div class="controls">
            <input type="text" name="name" id="name" class="input-xlarge" value="{{ $data['name'] }}">
          </div>
        </div>
		<div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="description">Description</label>
          <div class="controls">
            <textarea name="description" id="description" class="input-xlarge">{{ $data['description'] }}</textarea>
          </div>
        </div>
		<div class="control-group" id="fileContainer">

				  <!-- Text input-->
				  <div class="control-label">Tasks</div>
				  <div id="delTask"></div>
				  <div class="controls" id="taskLists">
					 <img class="loading" alt="loading" src="{{ URL::to('/') }}/images/loading-icons/loading11.gif">
				  </div>
				</div>
		<div class="control-group">
		<div class="controls">
			<input type="button" class="btn" value="Tambah Task" onclick="tambahTask()"/>
          </div>
		</div>

    <div class="control-group">
          <!-- Button -->
          <div class="controls">
            <input type="button" class="btn btn-success" value="Simpan" onclick="saveTemplate()"/>
			<a type="button" class="btn btn-info" href="{{ URL::to('/supervisor/template') }}">Kembali</a>
          </div>
        </div>

    </fieldset>
  </form>
@stop