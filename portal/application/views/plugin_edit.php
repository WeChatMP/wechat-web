<div class="board">
	<div class="board-text">
		<h2>编辑插件: <?php echo $plugin['key'];?></h2>
		<form action="<?php echo site_url('/plugin/edit/' . $plugin['key'] . '/save');?>" method="post" id="form-edit">
			<p>CHAIN: <input type="text" class="txt" name="chain" value="<?php echo $plugin['chain'];?>"/> 标识: <input type="text" class="txt" name="key" value="<?php echo $plugin['key'];?>"/></p>
			<p>名称: <input type="text" class="txt" name="name" value="<?php echo $plugin['name'];?>"/> 描述: <input type="text" class="txt" name="desc" value="<?php echo $plugin['desc'];?>"/></p>
			<p>插件代码头部 (header):</p>
			<p><textarea name="header" cols="100" rows="5"><?php if (isset($plugin['header'])){echo $plugin['header'];}?></textarea></p>
			<p>指令解析器 (parser):</p>
			<p><textarea name="parser" cols="100" rows="8"><?php echo $plugin['parser'];?></textarea></p>
			<p>指令处理器 (handler):</p>
			<p><textarea name="handler" cols="100" rows="10"><?php echo $plugin['handler'];?></textarea></p>
			<button type="submit" class="btn1">提交</button>
		</form>
		<div class="clear"></div>
	</div>
</div>

<script type="text/javascript">
$('#form-edit').submit(function()
{
	$.post($('#form-edit').attr('action'), $('#form-edit').serialize(), function(data) {
		hint('操作成功!');
		openPage('plugin');
	}, 'json');
	return false;
});
</script>