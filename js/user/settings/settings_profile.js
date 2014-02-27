$(document).ready(function(){

	$("#profile-form").submit(function() {
		if($("#profile-success").length > 0) {
			$("#profile-success").remove();
		}

		if(!check_name()) {
			return false;
		}

		var name = $("#name").val();

		$.ajax({
			url: $("#site-url").html() + "/settings/edit_profile",
			data: {name: name},
			type: "POST",
			dataType: "json",
			success: function(data) {
				if(data.code == 1) {
					$("#header").after("<div id='profile-success' class='success-hint'>修改资料成功</div>");
					$("#profile-success").css("top", $("#header").height());
				}
				else if(data.code == 2) {
				}
				else if(data.code == 3) {
				}
				else {

				}
			}
		});

		return false;
	});

	$("#name").blur(function() {
		check_name();
		return false;
	});
});

function check_name() {
	var name = $("#name").val();
	var name_length = name.length;

	if($("#name-error-hint").length == 0) {
		$("#settings-container").append("<span id='name-error-hint' class='error-hint'></span>");
		$("#name-error-hint").css({"top":$("#name").offset().top + 10, "left": $("#name").offset().left + $("#name").width() + 20});
	}

	if(name_length < 1 || name_length > 15) {
		$("#name-error-hint").html("昵称长度应为1~15个字符");
		$("#name").addClass("error-input");
		return false;
	}
	else {
		$("#name").removeClass("error-input");
	}

	$("#name-error-hint").remove();
	return true;
}
