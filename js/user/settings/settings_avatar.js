$(document).ready(function(){

	if($("#avatar-img").attr("src").indexOf("avatar-default") >= 0) {
		$("#delete-avatar-link").css("display", "none");
	}

	if($("#avatar-success").length > 0) {
		$("#avatar-success").remove();
	}

	$("#avatar").change(function() {
		if($("#avatar-error-hint").length > 0) {
			$("#avatar-error-hint").remove();
		}

		if($("#avatar-success").length > 0) {
			$("#avatar-success").remove();
		}
	});

	$("#avatar-form").submit(function() {

		if($("#avatar-success").length > 0) {
			$("#avatar-success").remove();
		}

		if($("#avatar").val() == "") {
			if($("#avatar-error-hint").length == 0) {
				$("#settings-container").append("<span id='avatar-error-hint' class='error-hint'></span>");
				$("#avatar-error-hint").css({"top":$("#avatar").offset().top + 10, "left": $("#avatar").offset().left + $("#avatar").width() + 20});
			}
			$("#avatar-error-hint").html("请选择图片");
			return false;
		}
		else {
			if($("#avatar-error-hint").length != 0) {
				$("#avatar-error-hint").remove();
			}
		}

		$("#avatar-form").ajaxSubmit({
			dataType: "json",
			url: $("#site-url").html() + "/settings/upload_avatar",
			type: "post",
			success: upload_success,
			error: function() {
			}
		});

		return false;
	});

	$("#delete-avatar-link").click(function() {
		
		if($("#avatar-success").length > 0) {
			$("#avatar-success").remove();
		}

		if(confirm("确定删除头像？")) {
			$.ajax({
				url: $("#site-url").html() + "/settings/set_default_avatar",
				data: {},
				type: "POST",
				dataType: "json",
				success: function(data) {
					if(data.code == 1) {
						$("#header").after("<div id='avatar-success' class='success-hint'>删除头像成功</div>");
						$("#avatar-success").css("top", $("#header").height());
						var new_folder = $("#avatar-img").attr("src").substring(0, $("#avatar-img").attr("src").lastIndexOf('/') + 1) + data.data;
						$("#avatar-img").attr("src", new_folder);
						$("#delete-avatar-link").css("display", "none");
					}
				}
			});
		}

	});
});

function upload_success(data) {
	if(data.code == 1) {
		$("#header").after("<div id='avatar-success' class='success-hint'>修改头像成功</div>");
		$("#avatar-success").css("top", $("#header").height());
		var new_folder = $("#avatar-img").attr("src").substring(0, $("#avatar-img").attr("src").lastIndexOf('/') + 1) + data.data;
		$("#avatar-img").attr("src", new_folder);
		$("#delete-avatar-link").css("display", "inline");
	}
	else if(data.code == 3) {
		if($("#avatar-error-hint").length == 0) {
			$("#settings-container").append("<span id='avatar-error-hint' class='error-hint'></span>");
			$("#avatar-error-hint").css({"top":$("#avatar").offset().top + 10, "left": $("#avatar").offset().left + $("#avatar").width() + 20});
		}
		$("#avatar-error-hint").html("上传失败，请检查上传文件");
	}
}