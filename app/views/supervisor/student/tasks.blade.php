@extends('supervisor/student/layout')

@section('pageTitle')
	{{ (strtolower(substr(trim($data['name']),-1))=='s')?$data['name']."'":$data['name']."'s" }} Tasks
@stop

@section('task.nav') selected="selected" @stop
@section('task.menu') active @stop

@section('addResourceTop')
<style>
.info h2 {
  margin: 0;
}
</style>
<link rel="stylesheet" href="{{ URL::to('/') }}/app-css/task.css">
@stop

@if($isSupervisor&&$data['status']==2)
@section('addResource')
<script src="{{ URL::to('/') }}/javascripts/overlay.js" type="text/javascript"></script>
<script src="{{ URL::to('/') }}/javascripts/task.js" type="text/javascript"></script>
<script src="{{ URL::to('/') }}/javascripts/jquery.form.min.js" type="text/javascript"></script>
<script>
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
var taskElement=[];
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
		if(data.code==1){
			$("#notif").attr("class", "alert alert-success closeNotif");
			$("#notif").html("Sukses menambah task");
			displayNotif();
		}else{
			$("#notif").attr("class", "alert alert-error closeNotif");
			$("#notif").html("Gagal menambah task");
			displayNotif();
		}
		reloadTask();
		$(document.task.simpan).prop("disabled",false);
		$(document.task.batal).prop("disabled",false);
		$("#tasks").slideToggle();
	},
	error: function(ex) {
		$("#notif").attr("class", "alert alert-error closeNotif");
		$("#notif").html("Gagal menambah task");
		displayNotif();
		$(document.task.simpan).prop("disabled",false);
		$(document.task.batal).prop("disabled",false);
		$("#tasks").slideToggle();
	}  
});
function showTask(){
	var date=new Date();
	var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
	  "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
	];
	var text="";
	for(var i=0;i<taskElement.length;i++){
		text+="<li>";
		text+="<div class='overview span4'>";
        text+="<p class='main-detail'>"+taskElement[i].date+"</p>";
        text+="<p class='sub-detail'> </p>";
		if(taskElement[i].status==0)
			text+="<span class='label label-success'>Active</span> ";
		if(taskElement[i].comment.length==0)
			text+="<span class='label label-info'>New</span>";
        text+="</div>";
        text+="<div class='info span8'>";
		text+="<h2>"+taskElement[i].name+"</h2>";
        text+="<p>"+taskElement[i].description+"</p>";
        text+="<a class='btn btn-mini' href='{{ URL::to('/student/'.$data['_id'].'/view') }}/"+taskElement[i].id_task+"'>View Task</a>";
        text+="</div><div class='clearfix'></div>";
		text+="</li>";
	}
	$("#task-items").html(text);
	$("#info").html("Ada "+taskElement.length+" Task yang harus diselesaikan.")
}
function reloadTask(){
	$("#task-items").html("<img class=\"loading\" alt=\"loading\" src=\"{{ URL::to('/') }}/images/loading-icons/loading11.gif\">");
	$.ajax({  
		type: 'GET',  
		url: '<?php echo URL::to('/'); ?>/student/{{ $data["_id"]}}/getTasks',
		contentType: 'application/json',
		success: function(data){
			try{
				taskElement=JSON.parse(data);
				showTask();
			}catch(err){
				$("#notif").attr("class", "alert alert-error closeNotif");
				$("#notif").html("Internal Server Error");
				displayNotif();
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
function tambahTask(){
	$('#judulTipe').html("Tambah Task");
	document.task.name.value="";
	document.task.description.value="";
	$(document.task).prop("action","{{ URL::to('/student/'.$data['_id'].'/task/add') }}");
	document.task.duration.value="";
	$('#fileContainer').html("");
	$('#delFile').html("");
	var file = $("#file");
	file.replaceWith(file.val('').clone(true));
	$("#tasks").slideToggle();
}
</script>
@stop
@endif

@section('content')
	@if($isSupervisor&&$data['status']==2)
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
					<input type="text" name="name" id="name" class="input-xlarge">
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
	@endif
    <div class="span8 main-content">
    <div class="row-fluid">
        <div class="row-fluid">
            <h2>{{ (strtolower(substr(trim($data['name']),-1))=='s')?$data['name']."'":$data['name']."'s" }} Tasks
                <span class="info" id="info">Ada {{ count($data['task']) }} Task yang harus diselesaikan.</span>
            </h2>
			@if($isSupervisor&&$data['status']==2)
			<a href="javascript:void(0)" onclick="tambahTask()" class="btn btn-mini">Tambah Task</a><br/><br/>
			@endif
            <ul class="item-summary" id="task-items">
            

            
                @foreach($data['task'] as $task)
                <li>
				<?php
					$date=new DateTime($task['created_date']['$date']);
				?>
                    <div class="overview span4">
                        <p class="main-detail">{{ date_format($date, 'M jS') }}</p>
                        <p class="sub-detail"> </p>
						@if($task['status']==0)
                        <span class="label label-success">Active</span>
						@endif
						@if(count($task['comment'])==0&&$task['status']==0)
						<span class="label label-info">New</span>
						@endif
                    </div>
                    <div class="info span8">
						<h2>{{ $task['name'] }}</h2>
                        <p>{{ $task['description'] }}</p>
						@if($isSupervisor)
                        <a class="btn btn-mini" href="{{ URL::to('/student/'.$data['_id'].'/view/'.$task['id_task']) }}">View Task</a>
						@endif
                    </div>
                    <div class="clearfix"></div>
                </li>
				@endforeach
            
            </ul>
        </div>
	</div>
</div>
@stop