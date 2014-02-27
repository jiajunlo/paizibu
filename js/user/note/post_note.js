function delete_note(note_id) {
	if(confirm("确定删除这篇日记？")) {
		$.ajax({
			url: $("#site-url").html() + "/note/delete_note",
			data: {note_id: note_id},
			type: "POST",
			dataType: "json",
			success: function(data) {
				if(data.code == 1) {
					if($("#next-note-link").length > 0) {
						location.href = $("#next-note-link").attr("href");
					}
					else if($("#last-note-link").length > 0) {
						location.href = $("#last-note-link").attr("href");
					}
					else {
						location.href = $("#site-url").html() + "/people";
					}
				}
				else {
					alert("删除失败");
				}
			}
		});
	}
}