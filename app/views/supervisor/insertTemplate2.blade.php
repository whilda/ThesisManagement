@extends('supervisor/layout')

@section('pageTitle')
	Task Template
@stop

@section('addResource')
<script>
var taskNum=1;
function addTask(){
	taskNum++;
	var element=document.createElement("div");
	element.className="control-group";
	element.id="task"+taskNum;
	$(element).append("<div class=\"control-label\"><b>Task#"+taskNum+"</b></div>");
	$(element).append("<div class=\"clearfix\"></div>");
	var element2=document.createElement("div");
	element2.className="control-group";
	var element3=document.createElement("div");
	element3.className="controls";
	$(element3).append("<input type=\"text\" name=\"tName[]\" id=\"tName\" class=\"input-xlarge\" value=\"\">");
	$(element2).append("<div class=\"control-label\">Name</div>",element3);
	$(element).append(element2);
	element2=document.createElement("div");
	element2.className="control-group";
	element3=document.createElement("div");
	element3.className="controls";
	$(element3).append("<textarea name=\"tDesc[]\" id=\"tDesc\" class=\"input-xlarge\"></textarea>");
	$(element2).append("<div class=\"control-label\">Description</div>",element3);
	$(element).append(element2);
	element2=document.createElement("div");
	element2.className="control-group";
	element3=document.createElement("div");
	element3.className="controls";
	$(element3).append("<input type=\"text\" name=\"tDur[]\" id=\"tDur\" maxlength=\"3\" class=\"input-small\"> hari");
	$(element2).append("<div class=\"control-label\">Duration</div>",element3);
	$(element).append(element2);
	$('#tasks').append(element);
}
function delTask(){
	if(taskNum>1){
		$("#task"+taskNum).remove();
		taskNum--;
	}
}
</script>
@stop

@section('template.nav') selected="selected" @stop
@section('template.menu') active @stop

@section('content')
    <h2>Tambah Template</h2>
  <form class="form-horizontal">
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
		<div class="control-group" id="tasks">
			<div class="control-group">
			  <div class="control-label"><b>Task#1</b></div>
			  <div class="clearfix"></div>
			  <div class="control-group">
				<div class="control-label">Name</div>
				  <div class="controls">
					<input type="text" name="tName[]" id="tName" class="input-xlarge" value="">
				  </div>
			  </div>
			  <div class="control-group">
				<div class="control-label">Description</div>
				  <div class="controls">
					<textarea name="tDesc[]" id="tDesc" class="input-xlarge"></textarea>
				  </div>
			  </div>
			  <div class="control-group">
				<div class="control-label">Duration</div>
				  <div class="controls">
					<input type="text" name="tDur[]" id="tDur" maxlength="3" class="input-small"> hari
				  </div>
			  </div>
			  <div class="control-group">
				<div class="control-label">File</div>
				  <div class="controls">
					<input type="file" name="tFile[]" id="tFile" maxlength="3" class="input-medium" multiple>
				  </div>
			  </div>
			</div>
        </div>
		<div class="control-group">
			<div class="controls">
				<input type="button" class="btn" value="+" onclick="addTask()"/> <input type="button" class="btn" value="-" onclick="delTask()"/>
			</div>
		</div>

    <div class="control-group">
          <!-- Button -->
          <div class="controls">
            <input type="submit" class="btn btn-success" value="Masukkan"/>
			<input type="button" class="btn btn-info" value="Kembali" onclick="window.history.go(-1)"/>
          </div>
        </div>

    </fieldset>
  </form>
@stop