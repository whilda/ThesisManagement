$(".closeNotif").on("click",function(){hideOver();});
$(".closeBtn").on("click",function(){$("#template").slideToggle();});
function tambahRef(){
	$('#judulTipe').html("Tambah Referensi");
	document.add.author.value="";
	document.add.title.value="";
    document.add.year.value="";
    $('#keywords').val("");
    $('#saveKey').html("");
    document.add.abstr.value="";
	$("#template").slideToggle();
}
var data;
var templates=[];
function confirmRef(dataRef){
	var id=dataRef.getAttribute("refId");
	if(id!=""){
		data=dataRef;
		$("#confirmText").html("Apakah anda yakin menghapus referensi ini?");
		$("#confirmYes").attr("onclick","delRef()");
		displayConfirm();
	}
}