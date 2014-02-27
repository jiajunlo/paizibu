$(document).ready(function(){
	$("#password-form").submit(function() {
		if($("#password-success").length > 0) {
			$("#password-success").remove();
		}

		if(!(check_old_password(false)&&check_new_password()&&check_confirm_password())) {
			return false;
		}

		var old_password = $("#old-password").val();
		var new_password = $("#new-password").val();

		$.ajax({
			url: $("#site-url").html() + "/settings/edit_password",
			data: {old_password: old_password, new_password: new_password},
			type: "POST",
			dataType: "json",
			success: function(data) {
				if(data.code == 1) {
					$("#header").after("<div id='password-success' class='success-hint'>修改密码成功</div>");
					$("#password-success").css("top", $("#header").height());
					$("#old-password").val('');
					$("#new-password").val('');
					$("#confirm-password").val('');
				}
				else if(data.code == 2) {
					
				}
				else if(data.code == 3) {
					check_old_password(true);
				}
				else {

				}
			}
		});

		return false;
	});

	$("#old-password").blur(function() {
		check_old_password(false);
		return false;
	});

	$("#new-password").blur(function() {
		check_new_password();
		return false;
	});
	
});

function check_old_password(wrong_password) {
	var password = $("#old-password").val();
	var password_length = password.length;

	if($("#old-password-error-hint").length == 0) {
		$("#settings-container").append("<span id='old-password-error-hint' class='error-hint'></span>");
		$("#old-password-error-hint").css({"top":$("#old-password").offset().top + 10, "left": $("#old-password").offset().left + $("#old-password").width() + 20});
	}

	if(password_length <= 0) {
		$("#old-password-error-hint").html("请输入旧密码");
		$("#old-password").addClass("error-input");
		return false;
	}
	else if(wrong_password) {
		$("#old-password-error-hint").html("旧密码错误");
		$("#old-password").addClass("error-input");
		return false;
	}
	else {
		$("#old-password").removeClass("error-input");
	}

	$("#old-password-error-hint").remove();
	return true;
}

function check_new_password() {
	var old_password = $("#old-password").val();
	var new_password = $("#new-password").val();
	var new_password_length = new_password.length;

	if($("#new-password-error-hint").length == 0) {
		$("#settings-container").append("<span id='new-password-error-hint' class='error-hint'></span>");
		$("#new-password-error-hint").css({"top":$("#new-password").offset().top + 10, "left": $("#new-password").offset().left + $("#new-password").width() + 20});
	}

	if(new_password_length < 6 || new_password_length > 18) {
		$("#new-password-error-hint").html("新密码长度应为6~18个字符");
		$("#new-password").addClass("error-input");
		return false;
	}
	else if(old_password == new_password) {
		$("#new-password-error-hint").html("新密码不能与旧密码相同");
		$("#new-password").addClass("error-input");
		return false;
	}
	else {
		$("#new-password").removeClass("error-input");
	}

	$("#new-password-error-hint").remove();
	return true;
}

function check_confirm_password() {
	var new_password = $("#new-password").val();
	var confirm_password = $("#confirm-password").val();

	if($("#confirm-password-error-hint").length == 0) {
		$("#settings-container").append("<span id='confirm-password-error-hint' class='error-hint'></span>");
		$("#confirm-password-error-hint").css({"top":$("#confirm-password").offset().top + 10, "left": $("#confirm-password").offset().left + $("#confirm-password").width() + 20});
	}

	if(new_password != confirm_password) {
		$("#confirm-password-error-hint").html("确认密码与新密码不一致");
		$("#confirm-password").addClass("error-input");
		return false;
	}
	else {
		$("#confirm-password").removeClass("error-input");
	}

	$("#confirm-password-error-hint").remove();
	return true;
}
