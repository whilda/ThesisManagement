@extends('student/layout')

@section('pageTitle')
	Library
@stop

@section('library.nav') selected="selected" @stop
@section('library.menu') active @stop

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
	background: url('{{ URL::to('/') }}/assets/overlay.png');
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
var refs=[];
var search="";
var newdata;
var maxpage;
var maxperpage=10;
function chSelection(){
    var allCheck=document.ref.all;
    var refName=document.ref.elements["refName[]"];
    var i;
    if(refName!=undefined){
        if(allCheck.checked){
            if(refName.length===undefined){
                refName.checked=true;
            }else{
                for(i=0;i<refName.length;i++){
                    refName[i].checked=true;
                }
            }
        }else{
            if(refName.length===undefined){
                refName.checked=false;
            }else{
                for(i=0;i<refName.length;i++){
                    refName[i].checked=false;
                }
            }
        }
    }
}
function notifMsg(){
	$("#notifMsg").slideUp();
}
function load(){
    if(loading==false){
        loading=true;
        if(search!="")
            search="/"+search;
        $("#loading").fadeIn("slow");
        $.ajax({  
            type: 'GET',  
            url: '<?php echo URL::to('/'); ?>/reference/get'+search,
            contentType: 'application/json',
            success: function(data){
                loading=false;
                $("#loading").fadeOut("fast");
                try{
                    refs=JSON.parse(data);
                    maxpage=Math.ceil(refs.length/maxperpage);
                    if(maxpage==0)
                        maxpage=1;
                    generatePagination(1);
                    showRef(1);
                }catch(err){
                    $("#notifMsg").hide();
                    $("#notifMsg").attr("class", "alert alert-error");
                    $("#notifMsg").html("Gagal meload referensi");
                    $("#notifMsg").slideDown();
                }
            },  
            error: function(ex) {
                loading=false;
                $("#loading").fadeOut("slow");
                $("#notifMsg").hide();
                $("#notifMsg").attr("class", "alert alert-error");
                $("#notifMsg").html("Gagal meload referensi");
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
            generated+="<li><a href='javascript:void(0)' onclick='showRef(1)'><i class=\"icon-backward\"></i></a></li>";
            generated+="<li><a href='javascript:void(0)' onclick='showRef("+(numpage-1)+")'><i class=\"icon-chevron-left\"></i></a></li>";
        }
        var i;
        for(i=numpage-4;i<numpage;i++){
            if(i<1)
                continue;
            generated+="<li><a href='javascript:void(0)' onclick='showRef("+i+")'>"+i+"</a></li>";
        }
        generated+="<li class=\"disabled\"><a>"+numpage+"</a></li>";
        for(i=numpage+1;i<(numpage+5)&&i<=maxpage;i++){
            generated+="<li><a href='javascript:void(0)' onclick='showRef("+i+")'>"+i+"</a></li>";
        }
        if(numpage==maxpage){
            generated+="<li class=\"disabled\"><a><i class=\"icon-chevron-right\"></i></a></li>";
            generated+="<li class=\"disabled\"><a><i class=\"icon-forward\"></i></a></li>";
        }else{
            generated+="<li><a href='javascript:void(0)' onclick='showRef("+(numpage+1)+")'><i class=\"icon-chevron-right\"></i></a></li>";
            generated+="<li><a href='javascript:void(0)' onclick='showRef("+maxpage+")'><i class=\"icon-forward\"></i></a></li>";
        }
        $(".pagination>center>ul").html(generated);
    }
}
function showRef(numpage){
    if(numpage<=maxpage){
        var i;
        var rowdata="";
        for(i=((numpage-1)*maxperpage);i<(numpage*maxperpage)&&i<refs.length;i++){
            rowdata+="<tr><td><input type='checkbox' name='refName[]' value='"+refs[i]._id+"'></td><td>"+refs[i].author+"</td><td><a href='{{ URL::to('/') }}/student/reference/view/"+refs[i]._id+"'>"+refs[i].title+"</a></td><td>"+refs[i].year+"</td></tr>";
        }
        $("#refData>tbody").html(rowdata);
        generatePagination(numpage);
        document.ref.all.checked=false;
    }
}
load();
function searchRef(){
    search=document.search.search.value;
    load();
}
function resetRef(){
    document.search.search.value="";
    search="";
    load();
}
function addRef(){
    $("#btnAdd").prop("disabled",true);
    document.ref.all.checked=false;
    cancelConfirm();
    var refName=document.ref.elements["refName[]"];
    var i;
    var added=[];
    if(refName.length===undefined){
        if(refName.checked)
            added.push(refName.value);
    }
    else{
        for(i=0;i<refName.length;i++){
            if(refName[i].checked)
                added.push(refName[i].value);
        }
    }
    if(added.length>0){
        model={
            "add":added
        };
        $.ajax({  
            type: 'POST',  
            url: '<?php echo URL::to('/'); ?>/student/reference/add',  
            data: JSON.stringify(model),  
            dataType: 'text',  
            contentType: 'application/json',
            success: function(data){
                $("#btnAdd").prop("disabled",false);
                if(data==1){
                    $("#notifMsg").hide();
                    $("#notifMsg").attr("class", "alert alert-success");
                    $("#notifMsg").html("Referensi berhasil ditambahkan");
                    $("#notifMsg").slideDown();
                    resetRef();
                }else{
                    $("#notifMsg").hide();
                    $("#notifMsg").attr("class", "alert alert-error");
                    $("#notifMsg").html("Referensi gagal ditambahkan");
                    $("#notifMsg").slideDown();
                }
            },
            error: function(req, status, ex) {
                $("#btnAdd").prop("disabled",false);
                $("#notifMsg").hide();
                $("#notifMsg").attr("class", "alert alert-error");
                $("#notifMsg").html("Referensi gagal ditambahkan");
                $("#notifMsg").slideDown();
            },  
            timeout:60000  
        });
    }
}
function confirmAdd(){
    var refName=document.ref.elements["refName[]"];
    var counter=0;
    if(refName.length===undefined){
        if(refName.checked)
            counter++;
    }else{
        for(var i=0;i<refName.length;i++){
            if(refName[i].checked)
                counter++;
        }
    }
    if(counter>0){
        $("#confirmText").html("Apakah anda yakin menambahkan referensi yang terpilih ke referensi anda?");
        $("#confirmYes").attr("onclick","addRef()");
        displayConfirm();
    }
}
</script>
@stop

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
	<div class="alert alert-error" id="notifMsg" style="display:none" onclick="notifMsg()"></div>
    <h2>Daftar Referensi</h2>
    <a class="btn btn" href="{{ URL::to('/') }}/student/library/reccomendation">Lihat Daftar Rekomendasi</a><br/><br/>
	<div class="well widget">
        <form class="form-inline" style="margin-bottom: 0px;" name="search" onsubmit="return false;">
            <input class="input-xlarge" placeholder="Cari Referensi..." type="text" name="search">
            <button class="btn" type="button" onclick="searchRef()"><i class="icon-search"></i> Go</button>
			<button class="btn" type="button" onclick="resetRef()"><i class="icon-refresh"></i> Reset</button>
        </form>
    </div>
	<form class="form-horizontal" name="ref" style="position:relative">
    <div class="overlay" id="loading"></div>
    <table class="table table-first-column-check" id="refData">
      <thead>
        <tr>
          <th><input type="checkbox" name="all" onchange="chSelection()"></th>
          <th>Author</th>
          <th>Title</th>
          <th>Year</th>
        </tr>
      </thead>
       <tbody> 
       </tbody>
    </table>
  </form>
  <div class="fancy pagination">
	<center>
	  <ul>
	  </ul>
	</center>
	</div>
	<input type="button" class="btn" value="Tambahkan ke Referensi Saya" id="btnAdd" onclick="confirmAdd()">
@stop