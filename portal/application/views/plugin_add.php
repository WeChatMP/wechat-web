<div class="board">
	<div class="board-text">
		<h2>添加插件</h2>
		<form action="<?php echo site_url('/plugin/add/save');?>" method="post" id="form-new">
			<p>CHAIN: <input type="text" class="txt" name="chain"/> 标识: <input type="text" class="txt" name="key"/></p>
			<p>名称: <input type="text" class="txt" name="name"/> 描述: <input type="text" class="txt" name="desc"/></p>
			<p>插件代码头部 (header):</p>
			<p><textarea name="header" cols="100" rows="5"></textarea></p>
			<p>指令解析器 (parser):</p>
			<p><textarea name="parser" cols="100" rows="8"></textarea></p>
			<p>指令处理器 (handler):</p>
			<p><textarea name="handler" cols="100" rows="10"></textarea></p>
			<button type="submit" class="btn1">提交</button>
		</form>
		<div class="clear"></div>
	</div>
</div>

<script type="text/javascript">
$('#form-new').submit(function()
{
	$.post($('#form-new').attr('action'), $('#form-new').serialize(), function(data) {
		hint('操作成功!');
		openPage('plugin');
	}, 'json');
	return false;
});
</script>