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
	var templateCode=dataTemplate.getAttribute("templateCode");
	if(templateCode!=""){
		data=dataTemplate;
		$("#confirmText").html("Apakah anda yakin menghapus template ini?");
		$("#confirmYes").attr("onclick","delTemplate()");
		displayConfirm();
	}
}