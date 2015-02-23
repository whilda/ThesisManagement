@extends('supervisor/layout')

@section('pageTitle')
	Task Template
@stop

@section('template.nav') selected="selected" @stop
@section('template.menu') active @stop

@section('addResourceTop')
<style>
	.overlay{
	width: 100%;
	height: 100%;
	position: absolute;
	left:0;
	top:0;
	text-align: center;
	z-index: 2000;
	background: url('../assets/overlay.png');
	background-repeat: repeat;
	}
</style>
<link rel="stylesheet" href="{{ URL::to('/') }}/app-css/task.css">
@stop

@section('addResource')
<script src="{{ URL::to('/') }}/javascripts/overlay.js" type="text/javascript"></script>
<script src="{{ URL::to('/') }}/javascripts/taskTemplate.js" type="text/javascript"></script>
<script src="{{ URL::to('/') }}/javascripts/spin.min.js" type="text/javascript"></script>
	<script src="{{ URL::to('/') }}/javascripts/jquery.spin.js" type="text/javascript"></script>
<script>
var opts = {
  lines: 10, // The number of lines to draw
  length: 8, // The length of each line
  width: 4, // The line thickness
  radius: 8, // The radius of the inner circle
  corners: 1, // Corner roundness (0..1)
  rotate: 0, // The rotation offset
  direction: 1, // 1: clockwise, -1: counterclockwise
  color: '#fff', // #rgb or #rrggbb or array of colors
  speed: 1, // Rounds per second
  trail: 60, // Afterglow percentage
  shadow: false, // Whether to render a shadow
  hwaccel: false, // Whether to use hardware acceleration
  className: 'spinner', // The CSS class to assign to the spinner
  zIndex: 2e9, // The z-index (defaults to 2000000000)
  top: '50%', // Top position relative to parent
  left: '50%' // Left position relative to parent
};
$("#loading").spin(opts);
var maxpage;
var maxperpage=10;
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
			"description":description
		}
		$.ajax({  
			type: 'POST',  
			url: '<?php echo URL::to('/'); ?>/supervisor/template/create',
			data: JSON.stringify(model),  
			dataType: 'text',
			contentType: 'application/json',
			success: function(data){
				$("#template").slideUp();
				$(button).prop("disabled",false);
				try{
					var output=JSON.parse(data);
					if(output.code==1){
						load();
						$("#notifMsg").hide();
						$("#notifMsg").attr("class", "alert alert-success");
						$("#notifMsg").html("Sukses menyimpan template");
						$("#notifMsg").slideDown();
					}else{
						$("#notifMsg").hide();
						$("#notifMsg").attr("class", "alert alert-error");
						$("#notifMsg").html("Gagal menyimpan template");
						$("#notifMsg").slideDown();
					}
				}catch(err){
					$("#notifMsg").hide();
					$("#notifMsg").attr("class", "alert alert-error");
					$("#notifMsg").html("Gagal menyimpan template");
					$("#notifMsg").slideDown();
				}
			},  
			error: function(ex) {
				$("#template").slideUp();
				$("#notifMsg").hide();
				$("#notifMsg").attr("class", "alert alert-error");
				$("#notifMsg").html("Gagal menyimpan field");
				$("#notifMsg").slideDown();
			},  
			timeout:60000  
		});
	}
	else{
		$(button).prop("disabled",false);
		$("#notifMsg").hide();
		$("#notifMsg").attr("class", "alert alert-error");
		$("#notifMsg").html("<ul>"+error+"</ul>");
		$("#notifMsg").slideDown();
	}
}
function load(){
	$("#loading").show();
	$.ajax({  
		type: 'GET',  
		url: '<?php echo URL::to('/'); ?>/supervisor/template/get',
		contentType: 'application/json',
		success: function(data){
			$("#loading").fadeOut("fast");
			try{
				templates=JSON.parse(data);
				maxpage=Math.ceil(templates.length/maxperpage);
				if(maxpage==0)
					maxpage=1;
				generatePagination(1);
				showTemplates(1);
			}catch(err){
				$("#notifMsg").hide();
				$("#notifMsg").attr("class", "alert alert-error");
				$("#notifMsg").html("Gagal meload template");
				$("#notifMsg").slideDown();
			}
		},  
		error: function(ex) {
			$("#loading").fadeOut("fast");
			$("#notifMsg").hide();
			$("#notifMsg").attr("class", "alert alert-error");
			$("#notifMsg").html("Gagal meload field");
			$("#notifMsg").slideDown();
		},  
		timeout:60000  
	});
}
load();
function generatePagination(numpage){
	if(numpage<=maxpage&&numpage>0){
		var generated="";
		if(numpage==1){
			generated+="<li class=\"disabled\"><a><i class=\"icon-backward\"></i></a></li>";
			generated+="<li class=\"disabled\"><a><i class=\"icon-chevron-left\"></i></a></li>";
		}else{
			generated+="<li><a href='javascript:void(0)' onclick='showTemplates(1)'><i class=\"icon-backward\"></i></a></li>";
			generated+="<li><a href='javascript:void(0)' onclick='showTemplates("+(numpage-1)+")'><i class=\"icon-chevron-left\"></i></a></li>";
		}
		var i;
		for(i=numpage-4;i<numpage;i++){
			if(i<1)
				continue;
			generated+="<li><a href='javascript:void(0)' onclick='showTemplates("+i+")'>"+i+"</a></li>";
		}
		generated+="<li class=\"disabled\"><a>"+numpage+"</a></li>";
		for(i=numpage+1;i<(numpage+5)&&i<=maxpage;i++){
			generated+="<li><a href='javascript:void(0)' onclick='showTemplates("+i+")'>"+i+"</a></li>";
		}
		if(numpage==maxpage){
			generated+="<li class=\"disabled\"><a><i class=\"icon-chevron-right\"></i></a></li>";
			generated+="<li class=\"disabled\"><a><i class=\"icon-forward\"></i></a></li>";
		}else{
			generated+="<li><a href='javascript:void(0)' onclick='showTemplates("+(numpage+1)+")'><i class=\"icon-chevron-right\"></i></a></li>";
			generated+="<li><a href='javascript:void(0)' onclick='showTemplates("+maxpage+")'><i class=\"icon-forward\"></i></a></li>";
		}
		$(".pagination>center>ul").html(generated);
	}
}
function showTemplates(numpage){
	if(numpage<=maxpage){
		var i;
		var rowdata="";
		for(i=((numpage-1)*maxperpage);i<(numpage*maxperpage)&&i<templates.length;i++){
			rowdata+="<div class=\"row-fluid blog-post\">";
			rowdata+="<div class=\"span12\">";
			rowdata+="<h4><strong><a href=\"{{ URL::to('/') }}/supervisor/template/"+templates[i].code+"\">"+templates[i].name+"</a></strong></h4>";
			rowdata+="<div class=\"row-fluid\">";
            rowdata+="<div class=\"post-summary\">";
            rowdata+="Code: "+templates[i].code+"<br/><br/>";
			rowdata+="Deskripsi:";
			rowdata+="<p>"+templates[i].description+"</p>";
            rowdata+="<p><a class=\"btn btn-mini\" href=\"{{ URL::to('/') }}/supervisor/template/"+templates[i].code+"\">Edit</a> <a class=\"btn btn-mini\" templateCode='"+templates[i].code+"' onclick=\"confirmDelTemplate(this)\">Delete</a></p>";
            rowdata+="</div>";
			rowdata+="</div>";
			rowdata+="<div class=\"row-fluid details\">";
            rowdata+="<i class=\"icon-tasks\"></i> Tasks: 0";
			rowdata+="</div></div></div>";
		}
		$("#blog-posts").html(rowdata);
		generatePagination(numpage);
	}
}
var deleted="";
function delTemplate(){
	var templateCode=data.getAttribute("templateCode");
	if(templateCode!=""){
		var found=false;
		for(i=0;i<templates.length;i++){
			if(templates[i].code==templateCode){
				deleted=i;
				found=true;
				break;
			}
		}
		if(found){
			$.ajax({  
			type: 'GET',  
			url: '<?php echo URL::to('/'); ?>/supervisor/template/delete/'+templateCode,
			contentType: 'application/json',
			success: function(outData){
				$("#loading").fadeOut("fast");
					if(outData==1){
						$("#notifMsg").hide();
						$("#notifMsg").attr("class", "alert alert-success");
						$("#notifMsg").html("Sukses menghapus template");
						$("#notifMsg").slideDown();
						templates.splice(deleted,1);
						data.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.removeChild(data.parentNode.parentNode.parentNode.parentNode.parentNode);
					}else{
						$("#loading").fadeOut("fast");
						$("#notifMsg").hide();
						$("#notifMsg").attr("class", "alert alert-error");
						$("#notifMsg").html("Gagal menghapus template");
						$("#notifMsg").slideDown();
					}
			},  
			error: function(ex) {
				$("#loading").fadeOut("fast");
				$("#notifMsg").hide();
				$("#notifMsg").attr("class", "alert alert-error");
				$("#notifMsg").html("Gagal menghapus template");
				$("#notifMsg").slideDown();
			},  
			timeout:60000  
		});
		}
	}
	cancelConfirm();
}
function notifMsg(){
	$("#notifMsg").slideUp();
}
</script>
@stop

@section('content')
	<div class="overlay" id="loading" style="display:none"></div>
	<div id="overlay" style="display:none"></div>
	<div id="confirm" class="overlayBoxes offset3 span6" style="display:none">
		<div class="alert alert-warning notif">
			<center>
				<b id="confirmText"></b><br/>
				<input type="button" id="confirmYes" class="btn btn-success" value="Ya">
				<input type="button" class="btn btn-info" onclick="cancelConfirm()" value="Tidak">
			</center>
		</div>
	</div>
	<div class="alert alert-error" id="notifMsg" style="display:none" onclick="notifMsg()"></div>
	<div id="template" style="display:none">
		<h2 id="judulTipe"></h2>
		<form class="form-horizontal overlay-content" name="template">
			<fieldset>
				<div class="control-group">

				  <!-- Text input-->
				  <label class="control-label" for="name">Name</label>
				  <div class="controls">
					<input type="text" name="name" id="name" class="input-xlarge" value="Nama template">
				  </div>
				</div>
				<div class="control-group">

				  <!-- Text input-->
				  <label class="control-label" for="description">Description</label>
				  <div class="controls">
					<textarea name="description" id="description" class="input-xlarge">Deskripsi Template</textarea>
				  </div>
				</div>
				<div class="control-group">

				  <!-- Text input-->
				  <div class="controls">
					<input type="button" class="btn btn-success" value="Simpan" onclick="saveTemplate(this)"> <input type="button" class="btn closeBtn" value="Batal">
				  </div>
				</div>
				
			</fieldset>
		</form>
	</div>
    <h2>Task Templates</h2>
	<div class="alert alert-error" id="notifMsg" style="display:none" onclick="notifMsg()"></div>
	<a class="btn btn-mini" onclick="tambahTemplate()">Tambah Template</a>
  <div id="blog-posts">

    
    
</div>
	<div class="pagination">
	<center>
	  <ul>
	  </ul>
	</center>
	</div>
@stop