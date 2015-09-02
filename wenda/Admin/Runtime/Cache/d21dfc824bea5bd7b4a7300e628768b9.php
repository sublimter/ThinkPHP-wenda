<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="__PUBLIC__/css/public.css" />
	<script type="text/javascript" src='__PUBLIC__/js/jquery-1.7.2.min.js'></script>
</head>
<body>
	<table class="table">
		<tr height='60'>
			<th>ID</th>
			<th>用户名</th>
			<th>回答数</th>
			<th>采纳数</th>
			<th>提问数</th>
			<th>金币</th>
			<th>经验值</th>
			<th>最后登录时间</th>
			<th>最后登录IP</th>
			<th>注册时间</th>
			<th>帐号状态</th>
			<th>操作</th>
		</tr>
		<?php if(is_array($user)): foreach($user as $key=>$v): ?><tr height='50'>
				<td align='center'><?php echo ($v["id"]); ?></td>
				<td><?php echo ($v["username"]); ?></td>
				<td align='center'><?php echo ($v["answer"]); ?></td>
				<td align='center'><?php echo ($v["adopt"]); ?></td>
				<td align='center'><?php echo ($v["ask"]); ?></td>
				<td align='center'><?php echo ($v["point"]); ?></td>
				<td align='center'><?php echo ($v["exp"]); ?></td>
				<td><?php echo (date('y-m-d H:i', $v["logintime"])); ?></td>
				<td><?php echo ($v["loginip"]); ?></td>
				<td><?php echo (date('y-m-d H:i', $v["registime"])); ?></td>
				<td align='center'>
					<?php if($v["lock"]): ?>锁定<?php else: ?>正常<?php endif; ?>
				</td>
				<td align='center'>
					<?php if($v["lock"]): ?><a href="<?php echo U('lockUser', array('id' => $v['id'], 'lock' => 0));?>">解除锁定</a>
					<?php else: ?>
						<a href="<?php echo U('lockUser', array('id' => $v['id'], 'lock' => 1));?>">锁定用户</a><?php endif; ?>
				</td>
			</tr><?php endforeach; endif; ?>
		<tr height='60'>
			<td colspan='12' align='center'>
				<?php echo ($page); ?>
			</td>
		</tr>
	</table>
</body>
</html>