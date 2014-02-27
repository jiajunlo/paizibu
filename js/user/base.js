$(document).ready(function(){
	$("#nav-profile").mouseover(function() {
		$("#nav-profile-more").css("visibility", "visible");
		$("#nav-profile-main").css({"color": "#FFFFFF", "background-color": "#1C1C1C"});
		$("#nav-profile-main img").css("opacity", "1.0");
	});

	$("#nav-profile").mouseout(function() {
		$("#nav-profile-more").css("visibility", "hidden");
		$("#nav-profile-main").css({"color": "#CFCFCF", "background-color": "#363636"});
		$("#nav-profile-main img").css("opacity", "0.8");
	});
});

function logout() {
	$.ajax({
		url: $("#site-url").html() + "/login/logout",
		data: {},
		type: "POST",
		dataType: "json",
		success: function(data) {
			if(data.code == 1) {
				location.href = $("#site-url").html() + "login";
			}
		}
	});
}
