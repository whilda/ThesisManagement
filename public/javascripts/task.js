$(".closeNotif").on("click",function(){hideOver();});
$(".closeBtn").on("click",function(){$("#tasks").slideToggle();});
function tambahTask(){
	if(!(document.template.type.value=="0"||document.template.oldName.value=="")){
		$('#judulTipe').html("Tambah Task");
		document.task.templateName.value=document.template.name.value;
		document.task.taskName.value="";
		document.task.taskDesc.value="";
		document.task.oldName.value="";
		document.task.type.value="1";
		document.task.taskDur.value="0";
		$('#fileContainer').html("");
		$('#delFile').html("");
		var file = $("#file");
		file.replaceWith(file.val('').clone(true));
		$("#tasks").slideToggle();
	}
}
function editTask(data){
	var taskName=data.getAttribute("taskName");
	if(!(document.template.type.value=="0"||document.template.oldName.value==""||taskName=="")){
		$('#judulTipe').html("Edit Task");
		document.task.templateName.value=document.template.name.value;
		document.task.taskName.value=data.getAttribute("taskName");
		document.task.taskDesc.value="Lama";
		document.task.oldName.value="Lama";
		document.task.type.value="2";
		document.task.taskDur.value="23";
		$('#fileContainer').html("");
		$('#delFile').html("");
		var element=document.createElement("div");
		var child1=document.createElement("div");
		child1.className="input-prepend";
		$(child1).html("<span class=\"add-on\">asd.png</span>");
		var child2=document.createElement("div");
		child2.className="input-append";
		$(child2).html("<span class=\"add-on\"><a href=\"javascript:void(0)\" fileName=\"asd.png\" taskFile=\"1\" onclick=\"confirmDelFile(this)\"><i class=\"icon-remove\"></i></a></span>");
		$(element).append(child1,child2);
		$("#fileContainer").append(element);
		var element=document.createElement("div");
		var child1=document.createElement("div");
		child1.className="input-prepend";
		$(child1).html("<span class=\"add-on\">def.png</span>");
		var child2=document.createElement("div");
		child2.className="input-append";
		$(child2).html("<span class=\"add-on\"><a href=\"javascript:void(0)\" fileName=\"def.png\" taskFile=\"2\" onclick=\"confirmDelFile(this)\"><i class=\"icon-remove\"></i></a></span>");
		$(element).append(child1,child2);
		$("#fileContainer").append(element);
		var file = $("#file");
		file.replaceWith(file.val('').clone(true));
		$("#tasks").slideToggle();
	}
}
var data;
function confirmDelTask(dataTask){
	var taskName=dataTask.getAttribute("taskName");
	if(taskName!=""){
		data=dataTask;
		$("#confirmText").html("Apakah anda yakin menghapus task "+taskName+"?");
		$("#confirmYes").attr("onclick","delTask()");
		displayConfirm();
	}
}
function delTask(){
	var taskName=data.getAttribute("taskName");
	if(taskName!=""){
		$("#delTask").append("<input type=\"hidden\" name=\"deleted[]\" value=\""+taskName+"\">");
		data.parentNode.parentNode.parentNode.parentNode.removeChild(data.parentNode.parentNode.parentNode);
		cancelConfirm();
	}
}
function confirmDelFile(dataFile){
	var fileName=dataFile.getAttribute("fileName");
	if(fileName!=""){
		data=dataFile;
		$("#confirmText").html("Apakah anda yakin menghapus file "+fileName+"?");
		$("#confirmYes").attr("onclick","delFile()");
		displayConfirm();
	}
}
function delFile(){
	var taskFile=data.getAttribute("taskFile");
	if(taskFile!=""){
		$("#delFile").append("<input type=\"hidden\" name=\"deleted[]\" value=\""+taskFile+"\">");
		data.parentNode.parentNode.parentNode.parentNode.removeChild(data.parentNode.parentNode.parentNode);
		cancelConfirm();
	}
}