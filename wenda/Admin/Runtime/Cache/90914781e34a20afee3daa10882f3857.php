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
			<th>回答内容</th>
			<th>提问时间</th>
			<th>操作</th>
		</tr>
		<?php if(is_array($answer)): foreach($answer as $key=>$v): ?><tr height='50'>
				<td align='center' width='8%'><?php echo ($v["id"]); ?></td>
				<td><?php echo ($v["content"]); ?></td>
				<td align='center'><?php echo (date('Y-m-d H:i', $v["time"])); ?></td>
				<td align='center'>
					<a href="<?php echo U('delAnswer', array('id' => $v['id'], 'uid' => $v['uid']));?>" class='del'>删除</a>
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