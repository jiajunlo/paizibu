$(document).ready(function(){

	$("#register-form").submit(function() {
		if(!(check_email(false)&&check_name()&&check_password()&&check_repassword())) {
			return false;
		}

		var email = $("#email").val();
		var name = $("#name").val();
		var password = $("#password").val();

		$.ajax({
			url: $("#site-url").html() + "/register/user_register",
			data: {email: email, name: name, password: password},
			type: "POST",
			dataType: "json",
			success: function(data) {
				if(data.code == 1) {
					location.href = "people";
				}
				else if(data.code == 2) {
					$("#sign-wrapper").append("<span id='email-error-hint' class='error-hint'>该邮箱已被注册</span>");
					$("#email-error-hint").css({"top":$("#email").offset().top + 10, "left": $("#email").offset().left + $("#email").width() + 20});
					$("#email").addClass("error-input");
				}
				else if(data.code == 3) {

				}
				else {

				}
			}
		});

		return false;
	});

	$("#email").blur(function() {
		check_email(true);
		return false;
	});

	$("#name").blur(function() {
		check_name();
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

	if($.browser.msie) {
		$("#register-form p").css({"width": "100%", "clear": "both", "float": "left", "margin-top": "20px"});
		$("#register-form input").css({"margin-top": "-10px"});
		$("#email").css({"width": "180px", "float": "right"});
		$("#name").css({"width": "180px", "float": "right"});
		$("#password").css({"width": "180px", "float": "right"});
		$("#repassword").css({"width": "180px", "float": "right"});
		$("#register-btn").css({"clear": "both", "width": "60px", "height": "30px", "float": "right", "font-size": "16px"});
		$(".other").css({"width": "180px", "clear": "none", "margin-top": "-23px", "margin-left": "-10px"});
		$("#email").before("邮箱");
		$("#name").before("昵称");
		$("#password").before("密码");
		$("#repassword").before("重复密码");
	}

});

function check_email(check_repeat) {
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
	
	if(check_repeat) {
		$.ajax({
			url: $("#site-url").html() + "/register/check_email",
			data: {"email": email},
			dataType: "json",
			type: "POST",
			success: function(data) {
				if(data.code == 2) {
					$("#email-error-hint").html("该邮箱已被注册");
					$("#email").addClass("error-input");
				}
				else {
					$("#email-error-hint").remove();
					$("#email").removeClass("error-input");
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
			}
		});
		return false;
	}
	$("#email-error-hint").remove();
	return true;
}

function check_name() {
	var name = $.trim($("#name").val());
	var name_length = name.length;

	if($("#name-error-hint").length == 0) {
		$("#sign-wrapper").append("<span id='name-error-hint' class='error-hint'></span>");
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

function check_password() {
	var password = $("#password").val();
	var password_length = password.length;

	if($("#password-error-hint").length == 0) {
		$("#sign-wrapper").append("<span id='password-error-hint' class='error-hint'></span>");
		$("#password-error-hint").css({"top":$("#password").offset().top + 10, "left": $("#password").offset().left + $("#password").width() + 20});
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