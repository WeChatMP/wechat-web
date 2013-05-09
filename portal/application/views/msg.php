<div class="board">
	<div class="board-text">
		<h2>服务消息管理</h2>
		<p>可鼠标左键点击消息ID设置微信公众服务的各类响应信息模板。</p>
		<p>注意：修改消息模板后，需要在“运行摘要”的“服务控制”中使用“刷新消息表”功能来使修改立即生效。</p>
		<div class="clear"></div>
	</div>
</div>
<div class="board">
	<div class="board-text">
		<h2>消息模板 (<?php echo count($msgs);?>)</h2>
		<table class="query-table">
			<thead class="query-table-head">
			<tr>
				<td>消息ID</td>
				<td>模板</td>
			</tr>
			</thead>
<?php
foreach ($msgs as $msg){
?>
			<tr id="msg_<?php echo $msg['id'];?>" class="msg-span">
				<td class="msg-id"><?php echo $msg['id'];?></td>
				<td class="msg-edit"><pre><?php echo htmlspecialchars($msg['text']);?></pre></td>
			</tr>
<?php
}?>
		</table>
		<div class="clear"></div>
	</div>
</div>

<script type="text/javascript">
var onEdit = {};

$('.msg-id').click(function(){
	var id = $(this).parent('tr').attr('id');
	id = id.substr(id.indexOf('_') + 1);
	
	if (onEdit[id] == 1) return;
	onEdit[id] = 1;
	
	var msgEdit = $(this).parent('tr').children('.msg-edit');
	var value = msgEdit.children('pre').html();
	
	msgEdit.html('<textarea id="msg-edit_' + id +'" class="txt" style="width: 700px" rows="0"></textarea><button class="btn1" id="msg-btn_' + id + '">编辑</button>');
	
	$('#msg-edit_' + id).val(value);
	$('#msg-btn_' + id).click(function(){
		var newValue = $('#msg-edit_' + id).val();
		msgEdit.html('<pre>' + newValue + '</pre>');
		
		onEdit[id] = 0;
		
		if (newValue != value)
		{
			$.post('<?php echo site_url('/msg/alter');?>', 'id=' + id + '&text=' + encodeURIComponent(newValue), function(data) {
				hint('消息模板编辑成功');
			}, 'json');
		}
	});
});
</script>