	<div id="main">
		<div id="settings">
			<div id="settings-nav" class="clearfix">
				<ul>
					<li><a id="profile-setting-link" href="<?php echo site_url('settings'); ?>"><img src="<?php echo base_url('images/icons/edit.png'); ?>">账户</a></li>
					<li><a id="password-setting-link" href="<?php echo site_url('settings/password'); ?>"><img src="<?php echo base_url('images/icons/lock.png'); ?>">密码</a></li>
					<li><a id="avatar-setting-link" href="<?php echo site_url('settings/avatar'); ?>"><img src="<?php echo base_url('images/icons/avatar.png'); ?>">头像</a></li>
					<li><a id="cover-setting-link" class="current-setting-link" href="<?php echo site_url('settings/cover'); ?>"><img src="<?php echo base_url('images/icons/cover.png'); ?>">版面</a></li>
				</ul>
			</div>
			<div id="settings-container">
				<div id="settings-cover">
					<h3>版面设置</h3>
					<form enctype="multipart/form-data" id="cover-form" class="settings-form clearfix" name="cover-form" method="post">
						<p><img id="cover-img" src="<?php echo base_url('images/cover').'/'.$user_cover; ?>"></p>
						<p><input id="cover" type="file" name="cover"></p>
						<p>
							<input id="cover-btn" class="submit-btn" type="submit" name="cover-btn" value="上传">
							<a id="delete-cover-link" href="javascript:void(0)">删除版面</a>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script src="<?php echo base_url('js/base/jquery.form.js'); ?>"></script>
	<script src="<?php echo base_url('js/user/settings/settings_cover.js'); ?>"></script>