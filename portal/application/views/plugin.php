<div class="board">
	<div class="board-text">
		<h2>插件管理</h2>
		<p>可在此创建或编辑微信服务插件。该操作将影响微信服务后台运行，非技术人员请勿操作。</p>
		<div class="clear"></div>
	</div>
</div>
<div class="board">
	<div class="board-text">
		<h2>当前插件 (<?php echo count($plugins);?>)</h2>
		<table class="query-table">
			<thead class="query-table-head">
			<tr>
				<td>标识</td>
				<td>名称</td>
				<td>描述</td>
				<td>操作</td>
			</tr>
			</thead>
<?php
foreach ($plugins as $plugin){
?>
			<tr>
				<td><?php echo $plugin['key'];?></td>
				<td><?php echo $plugin['name'];?></td>
				<td><?php echo $plugin['desc'];?></td>
				<td><a href="#" onclick="openPage('plugin/edit/<?php echo $plugin['key'];?>'); return false;">编辑</a> <a href="#" onclick="openPage('plugin/remove/<?php echo $plugin['key'];?>'); return false;">删除</a></td>
			</tr>
<?php
}?>
		</table>
		<h2><a href="#" onclick="openPage('plugin/add'); return false;">添加新插件</a></h2>
		<div class="clear"></div>
	</div>
</div>

<script type="text/javascript">

</script>