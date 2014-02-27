<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8" />
	<title>注册-拍子簿</title>
	<link rel="stylesheet" href="<?php echo base_url('css/base.css'); ?>" />
	<link rel="stylesheet" href="<?php echo base_url('css/sign.css'); ?>" />
	<link rel="shortcut icon" href="<?php echo base_url('images/favicon.ico'); ?>" type="image/x-icon" /> 
</head>

<body>
<div id="sign-wrapper">
	<div class="sign" id="register">
		<div class="logo">
			<a href="javascript:void(0);" title="拍子簿"><img alt="pazibu logo" src="<?php echo base_url('images/logo/logo.png'); ?>"></a>
		</div>
		<form class="sign-form" id="register-form">
			<p><input id="email" name="email" type="text" placeholder="邮箱" tabindex="1"></p>
			<p><input id="name" name="name" type="text" placeholder="昵称" tabindex="2"></p>
			<p><input id="password" name="password" type="password" placeholder="密码" tabindex="3"></p>
			<p><input id="repassword" name="repassword" type="password" placeholder="重复密码" tabindex="4"></p>
			<p><input class="submit-btn" id="register-btn" name="register-btn" type="submit" value="注册"tabindex="5"></p>
			<p class="other">已经有拍子簿账号？<a href="<?php echo site_url('login'); ?>" class="other-link">直接登录</a></p>
		</form>
	</div>
	<span id="site-url" style="display:none;"><?php echo site_url(); ?></span>
</div>
<script src="<?php echo base_url('js/base/jquery.js'); ?>"></script>
<script src="<?php echo base_url('js/user/sign/register.js'); ?>"></script>
</body>
</html>