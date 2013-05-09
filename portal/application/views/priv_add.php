<div class="board">
	<div class="board-text">
		<h2>添加用户</h2>
		<form action="<?php echo site_url('/priv/add/save');?>" method="post" id="form-new">
			<p class="column-2">用户名: <input type="text" class="txt" name="username"/></p>
			<p class="column-2">密码: <input type="password" class="txt" name="password"/></p>
			<p>角色: <input type="text" class="txt" name="role" value=""/></p>
			<p>权限许可: 
<?php
foreach ($this->acl as $key => $name)
{?>
				<input type="checkbox" name="acl[]" value="<?php echo $key;?>"/>
				<?php echo $name;?> 
<?php
}?>
			</p>
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
		openPage('priv');
	}, 'json');
	return false;
});
</script>