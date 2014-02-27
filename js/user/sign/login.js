$(document).ready(function(){
	
	$("#login-form").submit(function() {

		if(!(check_email()&&check_password())) {
			return false;
		}

		var email = $("#email").val();
		var password = $("#password").val();

		$.ajax({
			url: $("#site-url").html() + "/login/user_login",
			data: {email: email, password: password},
			type: "POST",
			dataType: "json",
			success: function(data) {
				if(data.code == 1) {
					location.href = $("#site-url").html() + "people";
				}
				else {
					$("#sign-wrapper").append("<span id='password-error-hint' class='error-hint'>账号与密码不一致</span>");
					$("#password-error-hint").css({"top":$("#password").offset().top + 10, "left": $("#password").offset().left + $("#password").width() + 20});
					$("#password").addClass("error-input");
				}
			}
		});

		return false;
	});

	$("#email").blur(function() {
		check_email();
		return false;
	});

	$("#password").blur(function() {
		check_password();
		return false;
	});

	if($.browser.msie) {
		$("#email").css({"width": "200px", "margin-left": "10px"});
		$("#password").css({"width": "200px", "margin-left": "10px"});
		$("#remember").css({"margin-left": "30px", "margin-top": "2px"});
		$("#login-btn").css({"clear": "both", "width": "60px", "height": "30px", "float": "right", "font-size": "16px"});
		$(".other").css({"float": "left", "margin-top": "25px", "margin-left": "30px"});
		$("#email").before("邮箱");
		$("#password").before("密码");
	}

});

function check_email() {
	if($("#email-error-hint").length > 0) {
		$("#email-error-hint").remove();
		$("#email").removeClass("error-input");
	}

	if($("#email").val() == "") {
		$("#sign-wrapper").append("<span id='email-error-hint' class='error-hint'>请输入账号</span>");
		$("#email-error-hint").css({"top":$("#email").offset().top + 10, "left": $("#email").offset().left + $("#email").width() + 20});
		$("#email").addClass("error-input");
		return false;
	}

	return true;
}

function check_password() {
	if($("#password-error-hint").length > 0) {
		$("#password-error-hint").remove();
		$("#password").removeClass("error-input");
	}

	if($("#password").val() == "") {
		$("#sign-wrapper").append("<span id='password-error-hint' class='error-hint'>请输入密码</span>");
		$("#password-error-hint").css({"top":$("#password").offset().top + 10, "left": $("#password").offset().left + $("#password").width() + 20});
		$("#password").addClass("error-input");
		return false;
	}

	return true;
}