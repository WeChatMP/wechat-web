<table class="query-table">
<thead class="query-table-head">
<tr>
<td width="160">时间</td>
<td width="100">OpenID</td>
<td width="120">指令</td>
<td>回复</td>
</tr>
</thead>
<?php
foreach ($logs as $row){
?>
<tr style="border-bottom: 1px solid #eee">
<td><?php echo date('Y-m-d H:i:s', $row['time']->sec);?></td>
<td><?php echo $row['user']['openid'];?></td>
<td style="word-break:break-all;"><?php echo $row['msg'];?></td>
<td style="word-break:break-all;"><?php echo str_replace("\n", "<br/>", $row['parsed']['replyMsg']);?></td>
</tr>
<?php
}?>
</table>
<p class="page-switcher">
<?php if ($page > 1) {?><a href="#" onclick="switchPage('<?php echo $page - 1;?>'); return false;">&lt;&lt;</a><?php }?> 
<?php
$c = 0;
for ($i = $page - 5; $i < $page + 10 && $c < 10; $i ++)
{
	if ($i < 1) {continue;}
	if ($i > $maxpage) {continue;}
	$c ++;
?>
	<?php if($i != $page){?><a href="#" onclick="switchPage('<?php echo $i;?>'); return false;"><?php }?><?php echo $i;?><?php if($i != $page){?></a> <?php }?> 
<?php
}?>
<?php if ($page < $maxpage) {?><a href="#" onclick="switchPage('<?php echo $page + 1;?>'); return false;">&gt;&gt;</a><?php }?> 
</p>