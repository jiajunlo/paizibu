<div id="main">
	<div id="container">
		<div id="cover" style="background-image: url(<?php echo base_url('images/cover/').'/'.$user_cover; ?>)">
		</div>
		<div id="user-info" class="clearfix">
			<div id="user-avatar" class="user-info-item">
				<img src="<?php echo base_url('images/avatar').'/'.$user_avatar; ?>">
			</div>
			<div id="user-name" class="user-info-item">
				<h4><?php echo $user_name; ?></h4>
			</div>
		</div>
		<div id="note-list-wrapper">
			<ul id="note-list">
			</ul>
		</div>
	</div>
</div>

<script src="<?php echo base_url('js/user/people/people.js'); ?>"></script>
