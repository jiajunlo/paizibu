$(document).ready(function(){

	$("#forget-form").submit(function() {
		
		if($(".password-success-hint").length == 0) {
			$(".password-success-hint").remove();
		}
		
		var email = $("#email").val();
		
		if(!check_email()) {
			return false;
		}

		$.ajax({
			url: $("#site-url").html() + "/password/forget/forget_password",
			data: {email: email},
			type: "POST",
			dataType: "json",
			success: function(data) {
				if(data.code == 1) {
					$("#sign-wrapper").append("<span class='password-success-hint'>邮件已成功发送</span>");
				}
				else if(data.code == 2) {
					$("#sign-wrapper").append("<span id='email-error-hint' class='error-hint'>该邮箱未注册</span>");
					$("#email-error-hint").css({"top":$("#email").offset().top + 10, "left": $("#email").offset().left + $("#email").width() + 20});
					$("#email").addClass("error-input");
				}
			}
		});

		return false;
	});
	
	$("#email").blur(function() {
		check_email(true);
		return false;
	});
});

function check_email() {
	var email = $.trim($("#email").val());
	var email_length = email.length;
	var email_reg = /^([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,4}$/;
	
	if($("#email-error-hint").length == 0) {
		$("#sign-wrapper").append("<span id='email-error-hint' class='error-hint'></span>");
		$("#email-error-hint").css({"top":$("#email").offset().top + 10, "left": $("#email").offset().left + $("#email").width() + 20});
	}

	if(email_length < 6 || email_length > 30) {
		$("#email").addClass("error-input");
		$("#email-error-hint").html("邮箱长度应为6~18个字符");
		return false;
	}
	else if(!email_reg.test(email)) {
		$("#email").addClass("error-input");
		$("#email-error-hint").html("邮箱格式错误");
		return false;
	}
	else {
		$("#email").removeClass("error-input");
	}
	
	$.ajax({
		url: $("#site-url").html() + "/register/check_email",
		data: {email: email},
		dataType: "json",
		type: "POST",
		success: function(data) {
			if(data.code == 1) {
				$("#email-error-hint").html("该邮箱未被注册");
				$("#email").addClass("error-input");
				return false;
			}
			else if(data.code == 2) {
				$("#email").removeClass("error-input");
				$("#email-error-hint").remove();
			}
			else {
				$("#email-error-hint").html("参数错误");
				$("#email").addClass("error-input");
				return false;
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
		}
	});
	
	//$("#email-error-hint").remove();
	return true;
}
