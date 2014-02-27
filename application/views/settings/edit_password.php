	<div id="main">
		<div id="settings">
			<div id="settings-nav" class="clearfix">
				<ul>
					<li><a id="profile-setting-link" href="<?php echo site_url('settings'); ?>"><img src="<?php echo base_url('images/icons/edit.png'); ?>">账户</a></li>
					<li><a id="password-setting-link" class="current-setting-link" href="<?php echo site_url('settings/password'); ?>"><img src="<?php echo base_url('images/icons/lock.png'); ?>">密码</a></li>
					<li><a id="avatar-setting-link" href="<?php echo site_url('settings/avatar'); ?>"><img src="<?php echo base_url('images/icons/avatar.png'); ?>">头像</a></li>
					<li><a id="cover-setting-link" href="<?php echo site_url('settings/cover'); ?>"><img src="<?php echo base_url('images/icons/cover.png'); ?>">版面</a></li>
				</ul>
			</div>
			<div id="settings-container">
				<div id="settings-password">
					<h3>修改密码</h3>
					<form id="password-form" class="settings-form clearfix" name="password-form">
						<p><span>旧的密码</span><input id="old-password" type="password" name="old_password" placeholder="旧的密码"></p>
						<p><span>新的密码</span><input id="new-password" type="password" name="new_password" placeholder="新的密码"></p>
						<p><span>确认密码</span><input id="confirm-password" type="password" name="confirm_password" placeholder="确认密码"></p>
						<p><input id="password-btn" class="submit-btn" type="submit" name="password-btn" value="修改"></p>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script src="<?php echo base_url('js/user/settings/settings_password.js'); ?>"></script>