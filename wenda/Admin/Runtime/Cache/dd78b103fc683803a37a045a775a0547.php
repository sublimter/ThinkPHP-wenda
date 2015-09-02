<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="__PUBLIC__/css/public.css" />
	<script type="text/javascript" src='__PUBLIC__/js/jquery-1.7.2.min.js'></script>
	<script type="text/javascript">
		window.onload = function () {
			$( '.del' ).click( function () {
				return confirm('确认删除？');
			} );
		}
	</script>
</head>
<body>
	<table class="table">
		<tr height='60'>
			<th>ID</th>
			<th>问题内容</th>
			<th>提问时间</th>
			<th>悬赏金币</th>
			<th>回答数</th>
			<th>操作</th>
		</tr>
		<?php if(is_array($ask)): foreach($ask as $key=>$v): ?><tr height='50'>
				<td width='8%' align='center'><?php echo ($v["id"]); ?></td>
				<td><?php echo ($v["content"]); ?></td>
				<td align='center' width='12%'><?php echo (date('Y-m-d H:i', $v["time"])); ?></td>
				<td align='center' width='8%'><?php if($v["reward"] > 0): echo ($v["reward"]); endif; ?></td>
				<td align='center' width='8%'><?php echo ($v["answer"]); ?></td>
				<td align='center' width='15%'>
					<a href="<?php echo U('delAsk', array('id' => $v['id']));?>" class='del'>删除</a>
				</td>
			</tr><?php endforeach; endif; ?>
		<tr height='60'>
			<td colspan='6' align='center'>
				<?php echo ($page); ?>
			</td>
		</tr>
	</table>
</body>
</html>