$(document).ready(function(){
	
	$("#reset-form").submit(function() {
		
		if($(".password-success-hint").length == 0) {
			$(".password-success-hint").remove();
		}
		
		if($(".params-error-hint").length == 0) {
			$(".params-error-hint").remove();
		}
		
		if(!(check_password()&&check_repassword())) {
			return false;
		}
		var serach_str = location.search;
		if(serach_str.length > 1) {
			serach_str = serach_str.substr(1);
			var params = serach_str.split('&');
			var id = params[0].split('=')[1];
			var mark = params[1].split('=')[1];
			
			if(id == "" || mark == "") {
				return false;
			}
		}
		else {
			return false;
		}
		var password = $("#password").val();

		$.ajax({
			url: $("#site-url").html() + "/password/reset/reset_password",
			data: {password: password, id: id, mark: mark},
			type: "POST",
			dataType: "json",
			success: function(data) {
				if(data.code == 1) {
					$("#sign-wrapper").append("<span class='password-success-hint'>修改成功</span>");
				}
				else if(data.code == 3) {
					$("#sign-wrapper").append("<span class='params-error-hint'>地址参数无效</span>");
				}
				else {

				}
			}
		});

		return false;
	});
	
	$("#password").blur(function() {
		check_password();
		return false;
	});

	$("#repassword").blur(function() {
		check_repassword();
		return false;
	});
	
});

function check_password() {
	var password = $("#password").val();
	var password_length = password.length;

	if($("#password-error-hint").length == 0) {
		$("#sign-wrapper").append("<span id='password-error-hint' class='error-hint'></span>");
		$("#password-error-hint").css({"top":$("#password").offset().top + 10, "left": $("#password").offset().left + 				$("#password").width() + 20});
	}

	if(password_length < 6 || password_length > 18) {
		$("#password-error-hint").html("密码长度应为6~18个字符");
		$("#password").addClass("error-input");
		return false;
	}
	else {
		$("#password").removeClass("error-input");
	}

	$("#password-error-hint").remove();
	return true;
}

function check_repassword() {
	var password = $("#password").val();
	var repassword = $("#repassword").val();

	if($("#repassword-error-hint").length == 0) {
		$("#sign-wrapper").append("<span id='repassword-error-hint' class='error-hint'></span>");
		$("#repassword-error-hint").css({"top":$("#repassword").offset().top + 10, "left": $("#repassword").offset().left + $("#repassword").width() + 20});
	}

	if(password != repassword) {
		$("#repassword-error-hint").html("密码与重复密码不一致");
		$("#repassword").addClass("error-input");
		return false;
	}
	else {
		$("#repassword").removeClass("error-input");
	}

	$("#repassword-error-hint").remove();
	return true;
}