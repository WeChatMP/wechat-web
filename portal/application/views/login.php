<!DOCTYPE HTML>
<html lang="zh">
<head>
	<title>WeChat at TJU</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
	<meta name="author" content="tju_tesseract"/>
	<meta name="version" content="1.0"/>
	<link href="/styles/general.css" type="text/css" rel="stylesheet"/>
	<link href="/styles/login.css" type="text/css" rel="stylesheet"/>
</head>

<body>

<script type="text/javascript" src="/js/jquery.js"></script>

<div id="g-bg" style="display: none">
	<img id="bg" src="/images/bg.jpg" style="width: 100%; height: auto; margin-left: 0px; margin-top: 0px; visibility: visible; opacity: 1;">
	<span class="bgshadow"></span>
</div>

<div id="g-login" style="display: none">
	<div id="logo">
		<img src="/images/logo.png"/>
	</div>
	<div id="logo-desc">
		天津大学微信服务管理平台
	</div>
	<div id="f-login">
		<div class="lg-row">
			<form action="<?php echo site_url('/login/attempt');?>" method="post" id="form-login">
				<input class="login-input" type="text" name="username" value=""/>
				<input class="login-input" type="password" name="password" value=""/>
				<button class="login-button">登录<b>></b></button>
				<div class="clear"></div>
			</form>
		</div>
		<div id="lg-error" style="display: none">
		
		</div>
	</div>
</div>

<div id="g-bottom">
	<div class="bottom-text">
		<div class="bottom-span">
			天津大学新媒体中心 ©2013
		</div>
		<div class="bottom-span">
			|
		</div>
		<div class="bottom-span">
			<a href="http://twt.tju.edu.cn/" target="_blank">天津大学</a> | 
			<a href="http://www.lib.tju.edu.cn/" target="_blank">天津大学图书馆</a> | 
			<a href="http://bbs.tju.edu.cn/" target="_blank">求实BBS</a>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	setTimeout("$('#g-bg').fadeIn('slow');", 200);
	setTimeout("$('#g-login').fadeIn('slow');", 900);
});
$('#form-login').submit(
	function()
	{
		$.post($(this).attr('action'), $('#form-login').serialize(), function(data) {
			if (data.success)
			{
				$('#lg-error').fadeIn().html('登录成功...');
				setTimeout("$('#g-login').fadeOut('slow')", 500);
				setTimeout("window.location.href='<?php echo site_url('/dashboard');?>'", 1000);
			}
			else
			{
				$('#lg-error').fadeIn().html('登录失败');
			}
		}, 'json');
		return false;
	}
);
</script>

</body>

</html>