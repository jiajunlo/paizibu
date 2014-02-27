<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8" />
	<title>拍子簿 - 记录时光</title>
	<link rel="stylesheet" href="<?php echo base_url('css/base.css'); ?>" />
	<link rel="stylesheet" href="<?php echo base_url('css/sign.css'); ?>" />
	<link rel="shortcut icon" href="<?php echo base_url('images/favicon.ico'); ?>" type="image/x-icon" /> 
</head>

<body>
<div id="sign-wrapper">
	<div class="sign" id="login">
		<div class="logo">
			<a href="javascript:void(0);" title="拍子簿"><img alt="pazibu logo" src="<?php echo base_url('images/logo/logo.png'); ?>"></a>
		</div>
		<form class="sign-form" id="login-form">
			<input id="email" name="email" type="text" placeholder="邮箱" tabindex="1">
			<input id="password" name="password" type="password" placeholder="密码" tabindex="2">
			<input id="remember" name="remember" type="checkbox" tabindex="3">
			<label for="remember">下次自动登录</label>
			<a class="rp-link" href="<?php echo site_url('password/forget'); ?>">忘记密码</a>
			<input class="submit-btn" id="login-btn" name="login-btn" type="submit" value="登陆"tabindex="4">
			<p class="other">没有拍子簿账号？<a href="<?php echo base_url('register'); ?>" class="other-link">注册一个</a></p>
		</form>
	</div>
	<span id="site-url" style="display:none;"><?php echo site_url(); ?></span>
</div>
</body>
<script src="<?php echo base_url('js/base/jquery.js'); ?>"></script>
<script src="<?php echo base_url('js/user/sign/login.js'); ?>"></script>
</html>