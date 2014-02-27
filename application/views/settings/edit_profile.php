	<div id="main">
		<div id="settings">
			<div id="settings-nav" class="clearfix">
				<ul>
					<li><a id="profile-setting-link" class="current-setting-link" href="<?php echo site_url('settings'); ?>"><img src="<?php echo base_url('images/icons/edit.png'); ?>">账户</a></li>
					<li><a id="password-setting-link" href="<?php echo site_url('settings/password'); ?>"><img src="<?php echo base_url('images/icons/lock.png'); ?>">密码</a></li>
					<li><a id="avatar-setting-link" href="<?php echo site_url('settings/avatar'); ?>"><img src="<?php echo base_url('images/icons/avatar.png'); ?>">头像</a></li>
					<li><a id="cover-setting-link" href="<?php echo site_url('settings/cover'); ?>"><img src="<?php echo base_url('images/icons/cover.png'); ?>">版面</a></li>
				</ul>
			</div>
			<div id="settings-container">
				<div id="settings-profile">
					<h3>账户设置</h3>
					<form id="profile-form" class="settings-form clearfix" name="profile-form">
						<p><span>邮箱</span><input id="email" class="disabled-input" type="text" name="email" value="<?php echo $user_email; ?>" disabled="disabled"></p>
						<p><span>昵称</span><input id="name" type="text" name="name" value="<?php echo $user_name; ?>"></p>
						<p><input id="profile-btn" class="submit-btn" type="submit" name="profile-btn" value="保存"></p>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script src="<?php echo base_url('js/user/settings/settings_profile.js'); ?>"></script>