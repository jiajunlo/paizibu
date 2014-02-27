$(document).ready(function(){

	if($("#cover-img").attr("src").indexOf("cover-default") >= 0) {
		$("#delete-cover-link").css("display", "none");
	}

	if($("#cover-success").length > 0) {
		$("#cover-success").remove();
	}

	$("#cover").change(function() {
		if($("#cover-error-hint").length > 0) {
			$("#cover-error-hint").remove();
		}

		if($("#cover-success").length > 0) {
			$("#cover-success").remove();
		}
	});

	$("#cover-form").submit(function() {

		if($("#cover-success").length > 0) {
			$("#cover-success").remove();
		}

		if($("#cover").val() == "") {
			if($("#cover-error-hint").length == 0) {
				$("#settings-container").append("<span id='cover-error-hint' class='error-hint'></span>");
				$("#cover-error-hint").css({"top":$("#cover").offset().top + 10, "left": $("#cover").offset().left + $("#cover").width() + 20});
			}
			$("#cover-error-hint").html("请选择图片");
			return false;
		}
		else {
			if($("#cover-error-hint").length != 0) {
				$("#cover-error-hint").remove();
			}
		}

		$("#cover-form").ajaxSubmit({
			dataType: "json",
			url: $("#site-url").html() + "/settings/upload_cover",
			type: "post",
			success: upload_success,
			error: function() {
			}
		});

		return false;
	});

	$("#delete-cover-link").click(function() {
		
		if($("#cover-success").length > 0) {
			$("#cover-success").remove();
		}

		if(confirm("确定删除版面？")) {
			$.ajax({
				url: $("#site-url").html() + "/settings/set_default_cover",
				data: {},
				type: "POST",
				dataType: "json",
				success: function(data) {
					if(data.code == 1) {
						$("#header").after("<div id='cover-success' class='success-hint'>删除版面成功</div>");
						$("#cover-success").css("top", $("#header").height());
						var new_folder = $("#cover-img").attr("src").substring(0, $("#cover-img").attr("src").lastIndexOf('/') + 1) + data.data;
						$("#cover-img").attr("src", new_folder);
						$("#delete-cover-link").css("display", "none");
					}
				}
			});
		}

	});
});

function upload_success(data) {
	if(data.code == 1) {
		$("#header").after("<div id='cover-success' class='success-hint'>修改版面成功</div>");
		$("#cover-success").css("top", $("#header").height());
		var new_folder = $("#cover-img").attr("src").substring(0, $("#cover-img").attr("src").lastIndexOf('/') + 1) + data.data;
		$("#cover-img").attr("src", new_folder);
		$("#delete-cover-link").css("display", "inline");
	}
	else if(data.code == 3) {
		if($("#cover-error-hint").length == 0) {
			$("#settings-container").append("<span id='cover-error-hint' class='error-hint'></span>");
			$("#cover-error-hint").css({"top":$("#cover").offset().top + 10, "left": $("#cover").offset().left + $("#cover").width() + 20});
		}
		$("#cover-error-hint").html("上传失败，请检查上传文件");
	}
}