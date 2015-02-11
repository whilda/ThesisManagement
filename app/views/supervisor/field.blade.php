@extends('supervisor/layout')

@section('pageTitle')
	Field List
@stop

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
	var loading=false;
	var fields;
	var maxpage;
	var search="";
	var newdata;
		function chSelection(){
			var allCheck=document.field.all;
			var fieldName=document.field.elements["fieldName[]"];
			var i;
			if(allCheck.checked){
				if(fieldName.length===undefined){
					fieldName.checked=true;
				}else{
					for(i=0;i<fieldName.length;i++){
						fieldName[i].checked=true;
					}
				}
			}else{
				if(fieldName.length===undefined){
					fieldName.checked=false;
				}else{
					for(i=0;i<fieldName.length;i++){
						fieldName[i].checked=false;
					}
				}
			}
		}
		function notifMsg(){
			$("#notifMsg").slideUp();
		}
		function load(){
			if(loading==false){
				loading==true;
				if(search!="")
					search="/"+search;
				$("#loading").fadeIn("slow");
				$.ajax({  
					type: 'GET',  
					url: '<?php echo URL::to('/'); ?>/field/get'+search,
					contentType: 'application/json',
					success: function(data){
						$("#loading").fadeOut("fast");
						try{
							fields=JSON.parse(data);
							maxpage=Math.ceil(fields.length/10);
							if(maxpage==0)
								maxpage=1;
							generatePagination(1);
							showField(1);
						}catch(err){
							$("#notifMsg").hide();
							$("#notifMsg").attr("class", "alert alert-error");
							$("#notifMsg").html("Gagal meload field");
							$("#notifMsg").slideDown();
						}
					},  
					error: function(ex) {
						loading==false;
						$("#loading").fadeOut("slow");
						$("#notifMsg").hide();
						$("#notifMsg").attr("class", "alert alert-error");
						$("#notifMsg").html("Gagal meload field");
						$("#notifMsg").slideDown();
					},  
					timeout:60000  
				});
			}
		}
		function generatePagination(numpage){
			if(numpage<=maxpage&&numpage>0){
				var generated="";
				if(numpage==1){
					generated+="<li class=\"disabled\"><a><i class=\"icon-backward\"></i></a></li>";
					generated+="<li class=\"disabled\"><a><i class=\"icon-chevron-left\"></i></a></li>";
				}else{
					generated+="<li><a href='javascript:void(0)' onclick='showField(1)'><i class=\"icon-backward\"></i></a></li>";
					generated+="<li><a href='javascript:void(0)' onclick='showField("+(numpage-1)+")'><i class=\"icon-chevron-left\"></i></a></li>";
				}
				var i;
				for(i=numpage-4;i<numpage;i++){
					if(i<1)
						continue;
					generated+="<li><a href='javascript:void(0)' onclick='showField("+i+")'>"+i+"</a></li>";
				}
				generated+="<li class=\"disabled\"><a>"+numpage+"</a></li>";
				for(i=numpage+1;i<(numpage+5)&&i<=maxpage;i++){
					generated+="<li><a href='javascript:void(0)' onclick='showField("+i+")'>"+i+"</a></li>";
				}
				if(numpage==maxpage){
					generated+="<li class=\"disabled\"><a><i class=\"icon-chevron-right\"></i></a></li>";
					generated+="<li class=\"disabled\"><a><i class=\"icon-forward\"></i></a></li>";
				}else{
					generated+="<li><a href='javascript:void(0)' onclick='showField("+(numpage+1)+")'><i class=\"icon-chevron-right\"></i></a></li>";
					generated+="<li><a href='javascript:void(0)' onclick='showField("+maxpage+")'><i class=\"icon-forward\"></i></a></li>";
				}
				$(".pagination>center>ul").html(generated);
			}
		}
		function showField(numpage){
			if(numpage<=maxpage){
				var i;
				var rowdata="";
				for(i=((numpage-1)*10);i<(numpage*10)&&i<fields.length;i++){
					rowdata+="<tr><td><input type='checkbox' name='fieldName[]' value='"+fields[i]._id+"'></td><td>"+fields[i]._id+"</td><td>"+fields[i].description+"</td></tr>";
				}
				$("#fieldData>tbody").html(rowdata);
				generatePagination(numpage);
				document.field.all.checked=false;
			}
		}
		load();
		function addField(button){
			var name=document.insert.name.value;
			var desc=document.insert.description.value;
			var error="";
			$(button).prop("disabled",true);
			if(name==""){
				error+="<li>Name tidak boleh kosong</li>";
			}
			if(desc==""){
				error+="<li>Description tidak boleh kosong</li>";
			}
			if(error==""){
				model={
					"name":name,
					"description":desc
				};
				newdata={
					"_id":name,
					"description":desc
				}
				$.ajax({  
					type: 'POST',  
					url: '<?php echo URL::to('/'); ?>/supervisor/field/add',  
					data: JSON.stringify(model),  
					dataType: 'text',  
					contentType: 'application/json',
					success: function(data){
						$(button).prop("disabled",false);
						try{
							var output=JSON.parse(data);
							if(output.code==1){
								if(search==""){
									var i;
									var found=false;
									for(i=0;i<fields.length;i++){
										if(fields[i]._id==newdata._id){
											found=true;
											break;
										}
									}
									if(!found)
										fields.push(newdata);
									else
										fields[i].description=newdata.description;
									maxpage=Math.ceil(fields.length/10);
									if(maxpage==0)
										maxpage=1;
									generatePagination(1);
									showField(1);
								}else{
									resetField();
								}
								$("#notifMsg").hide();
								$("#notifMsg").attr("class", "alert alert-success");
								$("#notifMsg").html("Field insert success");
								$("#notifMsg").slideDown();
							}else{
								$("#notifMsg").hide();
								$("#notifMsg").attr("class", "alert alert-error");
								$("#notifMsg").html("Gagal menyimpan field");
								$("#notifMsg").slideDown();
							}
						}catch(err){
							$("#notifMsg").hide();
							$("#notifMsg").attr("class", "alert alert-error");
							$("#notifMsg").html("Gagal menyimpan field");
							$("#notifMsg").slideDown();
						}
					},  
					error: function(req, status, ex) {
						$(button).prop("disabled",false);
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
		function searchField(){
			search=document.search.search.value;
			load();
		}
		function resetField(){
			document.search.search.value="";
			search="";
			load();
		}
		function delField(){
			$("#btnHapus").prop("disabled",true);
			document.field.all.checked=false;
			cancelConfirm();
			var fieldName=document.field.elements["fieldName[]"];
			var i;
			var deleted=[];
			if(fieldName.length===undefined){
				if(fieldName.checked)
					deleted.push(fieldName.value);
			}
			else{
				for(i=0;i<fieldName.length;i++){
					if(fieldName[i].checked)
						deleted.push(fieldName[i].value);
				}
			}
			if(deleted.length>0){
				model={
					"names":deleted
				};
				$.ajax({  
					type: 'POST',  
					url: '<?php echo URL::to('/'); ?>/supervisor/field/del',  
					data: JSON.stringify(model),  
					dataType: 'text',  
					contentType: 'application/json',
					success: function(data){
						$("#btnHapus").prop("disabled",false);
						if(data==1){
							$("#notifMsg").hide();
							$("#notifMsg").attr("class", "alert alert-success");
							$("#notifMsg").html("Field sudah dihapus");
							$("#notifMsg").slideDown();
							resetField();
						}else{
							$("#notifMsg").hide();
							$("#notifMsg").attr("class", "alert alert-error");
							$("#notifMsg").html("Field gagal dihapus");
							$("#notifMsg").slideDown();
						}
					},
					error: function(req, status, ex) {
						$("#btnHapus").prop("disabled",false);
						$("#notifMsg").hide();
						$("#notifMsg").attr("class", "alert alert-error");
						$("#notifMsg").html("Field gagal dihapus");
						$("#notifMsg").slideDown();
					},  
					timeout:60000  
				});
			}
		}
		function confirmDel(){
			var fieldName=document.field.elements["fieldName[]"];
			var counter=0;
			if(fieldName.length===undefined){
				if(fieldName.checked)
					counter++;
			}else{
				for(var i=0;i<fieldName.length;i++){
					if(fieldName[i].checked)
						counter++;
				}
			}
			if(counter>0){
				$("#confirmText").html("Apakah anda yakin menghapus field yang terpilih?");
				$("#confirmYes").attr("onclick","delField()");
				displayConfirm();
			}
		}
	</script>
@stop

@section('field.nav') selected="selected" @stop
@section('field.menu') active @stop

@section('content')
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
    <h2>Field List</h2>
	<div class="alert alert-error" id="notifMsg" style="display:none" onclick="notifMsg()"></div>
	<div class="well widget">
        <form class="form-inline" style="margin-bottom: 0px;" name="insert">
			<h2>Insert Field</h2>
            <input class="input-xxlarge" placeholder="Name" type="text" name="name"><br/>
			<textarea class="input-xxlarge" placeholder="Description" name="description"></textarea><br/>
            <button class="btn" type="button" onclick="addField(this)"><i class="icon-save"></i>Save</button>
        </form>
    </div>
	<div class="well widget">
        <form class="form-inline" style="margin-bottom: 0px;" name="search">
            <input class="input-xlarge" placeholder="Search Field..." type="text" name="search">
            <button class="btn" type="button" onclick="searchField()"><i class="icon-search"></i> Go</button>
			<button class="btn" type="button" onclick="resetField()"><i class="icon-refresh"></i> Reset</button>
        </form>
    </div>
	<form class="form-horizontal" name="field" style="position:relative">
	<div class="overlay" id="loading"></div>
    <table class="table table-first-column-check" id="fieldData">
      <thead>
        <tr>
          <th><input type="checkbox" name="all" onchange="chSelection()"></th>
          <th>Name</th>
          <th>Description</th>
        </tr>
      </thead>
       <tbody> 
       </tbody>
    </table>
  </form>
  <div class="pagination">
	<center>
	  <ul>
	  </ul>
	</center>
	</div>
	<input type="button" class="btn" value="Hapus" id="btnHapus" onclick="confirmDel()">
@stop