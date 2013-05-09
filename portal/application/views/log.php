<div class="board">
	<div class="board-text">
		<h2>记录查询</h2>
		<form action="<?php echo site_url('/log/query');?>" method="post" id="form-query">
			<p class="column-2">起始时间: <input type="text" class="txt" name="start_time"/></p>
			<p class="column-2">结束时间: <input type="text" class="txt" name="end_time"/></p>
			<p class="column-2">消息ID: <input type="text" class="txt" name="reply"/></p>
			<p class="column-2">指令KEY: <input type="text" class="txt" name="key"/></p>
			<button type="submit" class="btn1">查询</button>
		</form>
		<div class="clear"></div>
	</div>
</div>

<div class="board" id="result">
	<div class="board-text">
		<h2>查询结果</h2>
		<div id="query-result"></div>
		<div class="clear"></div>
	</div>
</div>

<script type="text/javascript">
var page = 1;
function switchPage(p)
{
	page = p;
	sendQuery();
}
function sendQuery()
{
	$('#result').hide();
	$.post($('#form-query').attr('action') + '?page=' + page, $('#form-query').serialize(), function(data) {
		$('#query-result').html(data);
		$('#result').fadeIn();
	}, 'html');
	return false;
}
$('#form-query').submit(sendQuery);
</script>