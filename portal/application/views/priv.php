<div class="board">
	<div class="board-text">
		<h2>平台权限管理</h2>
		<p>可在此设置登录此管理平台使用的账号、密码和角色。</p>
		<div class="clear"></div>
	</div>
</div>
<div class="board">
	<div class="board-text">
		<h2>当前账号 (<?php echo count($users);?>)</h2>
		<table class="query-table">
			<thead class="query-table-head">
			<tr>
				<td>用户名</td>
				<td>角色</td>
				<td>上次登录</td>
				<td>操作</td>
			</tr>
			</thead>
<?php
foreach ($users as $user){
?>
			<tr>
				<td><?php echo $user['username'];?></td>
				<td><?php echo $user['role'];?></td>
				<td><?php if ($user['last_login_time']){ echo date('Y-m-d H:i:s', $user['last_login_time']->sec), ' (', $user['last_login_ip'], ')';}?></td>
				<td><a href="#" onclick="openPage('priv/edit/<?php echo $user['username'];?>'); return false;">编辑</a> <a href="#" onclick="openPage('priv/revoke/<?php echo $user['username'];?>'); return false;">撤销</a></td>
			</tr>
<?php
}?>
		</table>
		<h2><a href="#" onclick="openPage('priv/add'); return false;">添加新用户</a></h2>
		<div class="clear"></div>
	</div>
</div>

<script type="text/javascript">

</script>