$(document).ready(function(){
	var default_title = set_default_title();

	$("#note-form").submit(function() {
		var content = $("#content").val();
		
		if(content == "") {
			if($("#content-error-hint").length == 0) {
				$("#note-container").append("<span id='content-error-hint' class='error-hint'></span>");
				$("#content-error-hint").css({"top":$("#content").offset().top + $("#content").height() + 20, "left": $("#content").offset().left});
			}

			$("#content-error-hint").html("内容不能为空");
			return false;
		}

		content = content.replace(/\n/g, "<br>");
		content = content.replace(/\s/g, "&nbsp;");

		var place = $("#place").val() == "" ? "无" : $("#place").val();
		var weather = $("#weather").val();
		var title = $("#title").val();
		if(title == "") {
			title = default_title;
		}

		$.ajax({
			url: $("#site-url").html() + "/note/add_note",
			data: {title: title, content: content, place: place, weather: weather},
			type: "POST",
			dataType: "json",
			success: function(data) {
				if(data.code == 1) {
					location.href = $("#site-url").html() + "/note/p/" + data.data;
				}
			}
		});
		
		return false;
	});

	$("#content").change(function(){
		if($("#content-error-hint").length > 0) {
			$("#content-error-hint").remove();
		}
	});
});

function set_default_title() {
	var current_date = new Date();
	var current_month = parseInt(current_date.getMonth()) + 1;
	var current_date_str = current_date.getFullYear() + "年" + current_month + "月" + current_date.getDate() + "日";
	return current_date_str;
}