$(document).ready(function(){
	last_note_id = -1;
	load_note();

	$(".note-main").live('mouseover', function() {
		$(this).children(".note-link").css("visibility", "visible");
	});

	$(".note-main").live('mouseout', function() {
		$(this).children(".note-link").css("visibility", "hidden");
	});

	$("#load-more-link").live('click', function() {
		$("#load-more").empty();
		$("#load-more").html("<span>加载中...</span>");
		load_note();
	});
});

function load_note() {
	$.ajax({
		url: $("#site-url").html() + "/people/note_list",
		data: {last_note_id: last_note_id},
		type: "POST",
		dataType: "json",
		success: function(data) {
			if(data.code == 1) {
				var note_id, note_title, note_content, note_date, note_time, note_day, note_month;
				var note_amount = data.data.length;

				if($("#load-more").length > 0) {
					$("#load-more").remove();
				}

				for(var i = 0; i < note_amount; i++) {
					note_id = data.data[i].note_id;
					note_title = data.data[i].note_title;
					note_content = data.data[i].note_content;
					note_time = data.data[i].note_time;

					note_content = note_content.replace(/&nbsp;/g, "");
					note_content = note_content.replace(/<br>/g, "&nbsp;&nbsp;&nbsp;&nbsp;");
					note_content = $.trim(note_content);
					if(note_content.length > 150) {
						note_content = note_content.substring(0, 200) + "...";
					}

					note_date = (note_time.split(' ')[0]).split('-');
					note_month = short_for_month(parseInt(note_date[1]));
					note_day = note_date[2];

					$("#note-list").append("<li class='note-item'>" + 
						"<div class='note-date'>" +
							"<div class='note-day'>" + note_day + "</div>" + 
							"<div class='note-month'>" + note_month + "</div>" + 
						"</div>" + 
						"<div class='note-main clearfix'>" +
							"<div class='note-link'>" + 
								"<a href='" + $("#site-url").html() + "note/p/" + note_id + "' title = '查看日记'></a>" + 
							"</div>" + 
							"<div class='trangle-big'><div class='trangle-small'></div></div>" + 
							"<div class='note-title'>" + 
								"<a href='" + $("#site-url").html() + "note/p/" + note_id + "' title = '" + note_title + "'>" + note_title + "</a>" + 
							"</div>" +
							"<div class='note-content'>" + note_content + "</div>" +
						"</div>" +
						"</li>");
				}

				last_note_id = note_id;

				if(note_amount < 10) {
					$("#note-list-wrapper").append("<div id='load-more'><span>没有更多的日志</span></div>");
				}
				else {
					$("#note-list-wrapper").append("<div id='load-more'><a id='load-more-link' href='javascript:void(0);'>加载更多</a></div>");
				}

			}
			else if(data.code == 2) {
				if(last_note_id == -1 ) {
					var current_date = new Date();
					var note_month = short_for_month(current_date.getMonth() + 1);
					var note_day = current_date.getDate() + 1;

					$("#note-list").append("<li class='note-item'>" + 
						"<div class='note-date'>" +
							"<div class='note-day'>" + note_day + "</div>" + 
							"<div class='note-month'>" + note_month + "</div>" + 
						"</div>" + 
						"<div class='note-main'>" +
							"<div class='trangle-big'><div class='trangle-small'></div></div>" +
							"<div class='first-note'><a href='" + $("#site-url").html() + "/note/add" + "'>写下第一篇日记</a></div>" +
						"</div>" +
						"</li>");
				}
				else {
					if($("#load-more").length > 0) {
						$("#load-more").empty();
						$("#load-more").html("<span>没有更多的日志</span>");
					}
					else {
						$("#note-list-wrapper").append("<div id='load-more'><span>没有更多的日志</span></div>");
					}
				}
			}
			else {

			}
		}
	});
}

function short_for_month(month_num) {
	var month_short;
	switch(month_num) {
		case 1: month_short = "JAN"; break;
		case 2: month_short = "FEB"; break;
		case 3: month_short = "MAR"; break;
		case 4: month_short = "APR"; break;
		case 5: month_short = "MAY"; break;
		case 6: month_short = "JUN"; break;
		case 7: month_short = "JUL"; break;
		case 8: month_short = "AUG"; break;
		case 9: month_short = "SEP"; break;
		case 10: month_short = "OCT"; break;
		case 11: month_short = "NOV"; break;
		case 12: month_short = "DEC"; break;
		default: month_short = "DEC";
	}
	return month_short;
}