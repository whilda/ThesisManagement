$("#overlay, .closeX").on("click",function(){hideOver();});
$(".loginbtn").on("click",function(){login();showOver();});
function showOver(){
	$("#overlay").fadeIn("slow");
	$("#overlayBox").fadeIn("slow");
}
function hideOver(){
	$("#overlay").fadeOut("slow");
	$("#overlayBox").fadeOut("slow");
}