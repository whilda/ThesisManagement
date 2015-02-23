$(".closeX").on("click",function(){hideOver();});
$(".loginbtn").on("click",function(){login();showOver();});
function showOver(){
	$("#overlay").fadeIn("slow");
	$("#overlayBox").fadeIn("slow");
}
function hideOver(){
	$("#overlay").fadeOut("slow");
	$("#overlayBox").fadeOut("slow");
}
function displayNotif(){
	showOver();
}
function displayConfirm(){
	$("#overlay").fadeIn("slow");
	$("#confirm").fadeIn("slow");
}
function cancelConfirm(){
	$("#overlay").fadeOut("slow");
	$("#confirm").fadeOut("slow");
}