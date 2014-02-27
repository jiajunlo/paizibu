	<div id="main">
		<div id="note">
			<div id="note-container">
				<div id="add-note">
					<h3>写日记</h3>
						<form id="note-form" name="note_form" class="clearfix">
							<div class="short-input">
								<span>天气<small>（可空）</small></span>
								<select id="weather" name="weather">
									<option value="1" selected="selected"></option>
									<option value="2">晴</option>
									<option value="3">阴</option>
									<option value="4">雨</option>
									<option value="5">雪</option>
								</select>
							</div>
							<div class="short-input">
								<span>地点<small>（可空）</small></span><input id="place" class="place" type="text" name="place">
							</div>
							<span>标题<small>（可空，默认为今天日期）</small></span>
							<input id="title" type="text" name="title">
							<span>内容</span>
							<textarea id="content" name="content"></textarea>
							<input id="note-btn" class="submit-btn" type="submit" value="添加">
						</form>
				</div>
			</div>
		</div>
	</div>

	<script src="<?php echo base_url('js/user/note/add_note.js'); ?>"></script>