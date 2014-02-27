<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8" />
	<title>重置密码 - 拍子簿</title>
	<link rel="stylesheet" href="<?php echo base_url('css/base.css'); ?>" />
	<link rel="stylesheet" href="<?php echo base_url('css/sign.css'); ?>" />
	<link rel="shortcut icon" href="<?php echo base_url('images/favicon.ico'); ?>" type="image/x-icon" /> 
</head>

<body>
<div id="sign-wrapper">
	<div class="sign" id="reset">
		<div class="logo">
			<a href="javascript:void(0);" title="拍子簿"><img alt="pazibu logo" src="<?php echo base_url('images/logo/logo.png'); ?>"></a>
		</div>
		<form id="reset-form" class="sign-form">
			<p><input id="password" name="password" type="password" placeholder="请输入新密码" tabindex="3"></p>
			<p><input id="repassword" name="repassword" type="password" placeholder="请重新输入密码" tabindex="4"></p>
			<p><input class="submit-btn" id="reset-btn" name="reset-btn" type="submit" value="提交"></p>
			<p class="other"><a href="<?php echo site_url('login'); ?>" class="other-link">返回登录</a></p>
		</form>
	</div>
	<span id="site-url" style="display:none;"><?php echo site_url(); ?></span>
</div>
</body>
<script src="<?php echo base_url('js/base/jquery.js'); ?>"></script>
<script src="<?php echo base_url('js/user/password/reset.js'); ?>"></script>
</html>