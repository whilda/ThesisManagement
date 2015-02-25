$(".closeNotif").on("click",function(){hideOver();});
$(".closeBtn").on("click",function(){$("#tasks").slideToggle();});

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