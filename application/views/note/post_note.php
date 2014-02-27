	<div id="main">
		<div id="note">
			<div id="note-container">
				<div id="post-note">
					<div id="post-note-info" class="clearfix">
						<h3 id="post-note-title"><?php echo $note_title; ?></h3>
						<div id="post-note-extra">
							<?php if($note_place != "无") { ?>
								<h4 id="note-place"><?php echo $note_place; ?></h4>
							<?php } ?>
							<?php if($note_weather != "无") { ?>
								<h4 id="note-weather"><?php echo $note_weather; ?></h4>
							<?php } ?>
						</div>
					</div>
					<div id="post-note-content"><?php echo $note_content; ?></div>
					<div id="post-note-time">
						<?php
							$note_time = strtotime($note_time); 
							echo date("Y-m-d H:i", $note_time); 
						?>
					</div>
					<a id="delete-note-link" href="javascript:void(0);" onClick="delete_note(<?php echo $note_id; ?>)">删除</a>
					<div id="prev-next-link">
						<?php if($last_note_id != NULL) { ?>
							<a id="last-note-link" href="<?php echo site_url('note/p').'/'.$last_note_id; ?>">上一篇</a>
						<?php } ?>
						<?php if($next_note_id != NULL) { ?>
							<a id="next-note-link" href="<?php echo site_url('note/p').'/'.$next_note_id; ?>">下一篇</a>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="<?php echo base_url('js/user/note/post_note.js'); ?>"></script>
	