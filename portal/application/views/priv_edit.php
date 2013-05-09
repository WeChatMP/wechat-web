<div class="board">
	<div class="board-text">
		<h2>编辑用户: <?php echo $user['username'];?></h2>
		<form action="<?php echo site_url('/priv/edit/' . $user['username'] . '/save');?>" method="post" id="form-edit">
			<p class="column-2">新密码 (不修改请留空): <input type="password" class="txt" name="password"/></p>
			<p class="column-2">角色: <input type="text" class="txt" name="role" value="<?php echo $user['role'];?>"/></p>
			<p>权限许可: 
<?php
foreach ($this->acl as $key => $name)
{?>
				<input type="checkbox" name="acl[]" value="<?php echo $key;?>"<?php if(in_array($key, $user['acl'])){echo ' checked="checked"';}?>/>
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
$('#form-edit').submit(function()
{
	$.post($('#form-edit').attr('action'), $('#form-edit').serialize(), function(data) {
		hint('操作成功!');
		openPage('priv');
	}, 'json');
	return false;
});
</script>