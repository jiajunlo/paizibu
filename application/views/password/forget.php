<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8" />
	<title>找回密码 - 拍子簿</title>
	<link rel="stylesheet" href="<?php echo base_url('css/base.css'); ?>" />
	<link rel="stylesheet" href="<?php echo base_url('css/sign.css'); ?>" />
	<link rel="shortcut icon" href="<?php echo base_url('images/favicon.ico'); ?>" type="image/x-icon" /> 
</head>

<body>
<div id="sign-wrapper">
	<div class="sign" id="forget">
		<div class="logo">
			<a href="javascript:void(0);" title="拍子簿"><img alt="pazibu logo" src="<?php echo base_url('images/logo/logo.png'); ?>"></a>
		</div>
		<form id="forget-form" class="sign-form">
			<p><span class></span><input id="email" name="email" type="text" placeholder="请输入你的注册邮箱"></p>
			<p><input class="submit-btn" id="forget-btn" name="forget-btn" type="submit" value="提交"></p>
			<p class="other"><a href="<?php echo site_url('login'); ?>" class="other-link">返回登录</a></p>
		</form>
	</div>
	<span id="site-url" style="display:none;"><?php echo site_url(); ?></span>
</div>
</body>
<script src="<?php echo base_url('js/base/jquery.js'); ?>"></script>
<script src="<?php echo base_url('js/user/password/forget.js'); ?>"></script>
</html>