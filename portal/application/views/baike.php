<div class="board">
	<div class="board-text">
		<h2>百科词条</h2>
		<p>当用户提供的指令无法被任何插件受理时，将查询百科服务，返回与指令内容准确匹配的关键词词条内容。</p>
		<div class="clear"></div>
	</div>
</div>
<div class="board">
	<div class="board-text">
		<h2>百科 (<?php echo count($baikes);?>)</h2>
		<table class="query-table">
			<thead class="query-table-head">
			<tr>
				<td>关键词</td>
				<td>内容</td>
			</tr>
			</thead>
<?php
foreach ($baikes as $baike){
?>
			<tr id="msg_<?php echo $baike['word'];?>" class="msg-span">
				<td class="msg-id" style="width: 100px"><?php echo $baike['word'];?> <a href="#" class="btn_remove">删除</a></td>
				<td class="msg-edit"><?php echo htmlspecialchars($baike['text']);?></td>
			</tr>
<?php
}?>
			<tr id="msgnew" class="msg-span">
				<td class="msg-id" style="width: 100px"><input id="msgnewword" class="txt" type="text" value=""/></td>
				<td class="msg-edit"><textarea id="msgnewtext" class="txt" style="width: 700px" rows="0"></textarea><button class="btn1 btn_add">添加</button></td>
			</tr>
		</table>
		<div class="clear"></div>
	</div>
</div>

<script type="text/javascript">
var onEdit = {};

$('.btn_remove').click(function()
{
	var p = $(this).parent('td').parent('tr');
	var id = p.attr('id');
	id = id.substr(id.indexOf('_') + 1);
	$.post('<?php echo site_url('/baike/remove');?>', 'word=' + encodeURIComponent(id), function(data) {
		p.remove();
		hint('词条删除成功');
	}, 'json');
	return false;
});

$('.btn_add').click(function(){
	$.post('<?php echo site_url('/baike/add');?>', 'word=' + encodeURIComponent($('#msgnewword').val()) + '&text=' + encodeURIComponent($('#msgnewtext').val()), function(data) {
		hint('词条添加成功');
		openPage('baike');
	}, 'json');
	return false;
});

$('.msg-id').click(function(){
	var id = $(this).parent('tr').attr('id');
	
	if (id == 'msgnew') return;
	
	id = id.substr(id.indexOf('_') + 1);
	
	if (onEdit[id] == 1) return;
	onEdit[id] = 1;
	
	var msgEdit = $(this).parent('tr').children('.msg-edit');
	var value = msgEdit.html();
	
	msgEdit.html('<textarea id="msg-edit_' + id +'" class="txt" style="width: 700px" rows="0"></textarea><button class="btn1" id="msg-btn_' + id + '">编辑</button>');
	
	$('#msg-edit_' + id).val(value);
	$('#msg-btn_' + id).click(function(){
		var newValue = $('#msg-edit_' + id).val();
		msgEdit.html(newValue);
		
		onEdit[id] = 0;
		
		if (newValue != value)
		{
			$.post('<?php echo site_url('/baike/alter');?>', 'word=' + encodeURIComponent(id) + '&text=' + encodeURIComponent(newValue), function(data) {
				hint('词条编辑成功');
			}, 'json');
		}
	});
});
</script>