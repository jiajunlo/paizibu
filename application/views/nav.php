	<div id="header">
		<div id="nav" class="clearfix">
			<div id="nav-logo">
				<a title="拍子簿" href="<?php echo site_url('people'); ?>"><img alt="pazibu logo" src="<?php echo base_url('images/logo/logo.png'); ?>"></a>
			</div>
			<ul id="nav-menu">
				<li id="nav-add" class="nav-menu-item">
					<a class="nav-menu-link" title="写日记" href="<?php echo site_url('note/add');?>"><img src="<?php echo base_url('images/icons').'/add.png'; ?>"></a>
				</li>
				<li id="nav-profile" class="nav-menu-item">
					<div id="nav-profile-main" class="nav-menu-link">
						<img src="<?php echo base_url('images/icons').'/settings.png'; ?>">
					</div>
					<ul id="nav-profile-more">
						<li><a href="<?php echo site_url('people');?>">我的主页</a></li>
						<li><a href="<?php echo site_url('settings');?>">个人设置</a></li>
						<li><a href="javascript:void(0)" onClick="logout()">退出</a></li>
					</ul>
				</li>
			</ul>
		</div>
		<span id="site-url" style="display:none;"><?php echo site_url(); ?></span>
	</div>
