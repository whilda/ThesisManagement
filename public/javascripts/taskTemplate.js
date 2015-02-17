$(".closeNotif").on("click",function(){hideOver();});
$(".closeBtn").on("click",function(){$("#template").slideToggle();});
function tambahTemplate(){
	$('#judulTipe').html("Tambah Template");
	document.template.name.value="";
	document.template.description.value="";
	$("#template").slideToggle();
}
var data;
var templates=[];
function confirmDelTemplate(dataTemplate){
	var templateName=dataTemplate.getAttribute("templateName");
	if(templateName!=""){
		data=dataTask;
		$("#confirmText").html("Apakah anda yakin menghapus template "+templateName+"?");
		$("#confirmYes").attr("onclick","delTemplate()");
		displayConfirm();
	}
}
function delTemplate(){
	var taskName=data.getAttribute("taskName");
	if(taskName!=""){
		$("#delTask").append("<input type=\"hidden\" name=\"deleted[]\" value=\""+taskName+"\">");
		data.parentNode.parentNode.parentNode.parentNode.removeChild(data.parentNode.parentNode.parentNode);
		cancelConfirm();
	}
}