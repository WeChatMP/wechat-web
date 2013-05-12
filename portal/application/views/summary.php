<?php 
$uptime = timespan($status['uptime']);
?>
<div class="board">
	<div class="board-text">
		<h2>服务情况摘要</h2>
		<p class="column-2">Wechat服务状态: <?php echo ($status['status'] == 'running') ? '<span class="ok">正常</span>' : '<span class="err">异常</span>';?></p>
		<p class="column-2">已持续运行: <?php echo $uptime['day'];?> 天 <?php echo $uptime['hour'];?> 小时 <?php echo $uptime['minute'];?> 分 <?php echo $uptime['second'];?> 秒</p>
		<p class="column-2">总计收到的请求数: <?php echo $status['request'];?></p>
		<p class="column-2">总计收到的指令数: <?php echo $status['hit'];?></p>
		<div class="clear"></div>
	</div>
</div>

<div class="board">
	<div class="board-text">
		<h2>指令测试</h2>
		<p>
			<table><tr><td><input type="text" class="txt" id="command"/></td><td><button onclick="sendCommand()" class="btn2">发送</button></td></tr></table>
		</p>
		<div id="reply" style="word-break:break-all"></div>
		<div class="clear"></div>
	</div>
</div>

<div class="board">
	<div class="board-text">
		<h2>服务控制</h2>
		<p style="float: left"><button onclick="sendSignal('reloadCmdDefs')" class="btn2">重载插件</button></p>
		<p style="float: left"><button onclick="sendSignal('reloadMsgDefs')" class="btn2">重载消息模板</button></p>
		<p style="float: left"><button onclick="sendSignal('purge')" class="btn2">更新缓存</button></p>
		<div class="clear"></div>
	</div>
</div>

<script type="text/javascript">
function sendSignal(sig)
{
	$('#signalReply').html('');
	$.post('<?php echo site_url('/summary/send_signal');?>', 'signal=' + sig, function(data) {
		if (data.success == 1)
		{
			hint('信号发送成功!');
		}
		else
		{
			hint('信号发送失败!');
		}
	}, 'json');
}
function sendCommand()
{
	$('#reply').html('');
	$.post('<?php echo site_url('/summary/send_command');?>', 'command=' + encodeURIComponent($('#command').val()), function(data) {
		if (data.success == 1)
		{
			$('#reply').html('<p>' + data.replyMsg.replace(/\n/g, '<br/>') + '<p><p class="ok">调试信息: <br/>消息ID: ' + data.reply + ', <br/>消息参数: ' + JSON.stringify(data.msgParam) + '</p>');
		}
		else
		{
			hint('发送消息失败!');
		}
	}, 'json');
}
</script>