<!DOCTYPE HTML>
<html lang="zh">
<head>
	<title>Dashboard - WeChat at TJU</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
	<meta name="author" content="tju_tesseract"/>
	<meta name="version" content="1.0"/>
	<link href="/styles/general.css" type="text/css" rel="stylesheet"/>
	<link href="/styles/dashboard.css" type="text/css" rel="stylesheet"/>
</head>

<body>

<script type="text/javascript" src="/js/jquery.js"></script>

<div id="hint" style="display: none">
	<div id="g-hint">
	</div>
</div>

<div id="p-container">
	<div id="g-dashboard">
		<div id="menu">
			<div id="logo">
			</div>
			<div id="menulist">
				<a class="menuitem" href="#summary" id="nav-summary">运行摘要</a>
				<a class="menuitem" href="#log" id="nav-log">记录查询</a>
				<a class="menuitem" href="#msg" id="nav-msg">消息模板</a>
				<a class="menuitem" href="#plugin" id="nav-plugin">插件管理</a>
				<a class="menuitem" href="#baike" id="nav-baike">百科</a>
				<a class="menuitem" href="#priv" id="nav-priv">权限管理</a>
				<a class="menuitem" href="#logout" id="nav-logout">退出登录</a>
			</div>
		</div>
		<div id="board" style="display: none">
		</div>
		<div id="loading" class="loading">
			<span class="tiptxt">加载中</span>
			<div class="load">&nbsp;</div>
		</div>
		<div id="bottom">
			<div class="bottom-link">
				<a href="http://twt.tju.edu.cn/" target="_blank">天津大学</a> | 
				<a href="http://www.lib.tju.edu.cn/" target="_blank">天津大学图书馆</a> | 
				<a href="http://bbs.tju.edu.cn/" target="_blank">求实BBS</a>
			</div>
			<div class="bottom-text">
				天津大学新媒体中心 ©2013
			</div>
			<div class="bottom-text">
				Powered by MongoDB, node.js & php. Designed by tju_tesseract.
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
function hint(msg)
{
	$('#g-hint').html(msg);
	$('#hint').fadeIn('50');
	setTimeout("$('#hint').fadeOut('50');", 2000);
}

function logout()
{
	window.location.href = '<?php echo site_url('/login');?>';
}
function openPage(url)
{
	$.get('<?php echo site_url('/');?>' + url + '?r=' + Math.random(), '', function(data) {
		$('#board').html(data);
		$('#loading').hide();
		$('#board').fadeIn(256);
	}, 'html');
}

window.onhashchange = function(){
	if (window.location.hash)
		$('#nav-' + window.location.hash.substr(1)).trigger('click');
};

$(document).ready(function(){
	$('.menuitem').click(
		function(){
			var page = $(this).attr('id').split('-')[1];
			$('#board').hide();
			$('#loading').fadeIn(256);
			setTimeout("openPage('" + page + "');", 256);
			$('.menuitem-curr').removeClass('menuitem-curr');
			$(this).addClass('menuitem-curr');
		}
	);
	if (window.location.hash)
	{
		$('#nav-' + window.location.hash.substr(1)).trigger('click');
	}
	else
	{
		$('.menuitem').eq(0).trigger('click');
	}
});
</script>

</body>

</html>