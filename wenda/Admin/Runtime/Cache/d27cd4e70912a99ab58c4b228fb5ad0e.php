<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="__PUBLIC__/css/public.css" />
	<script type="text/javascript" src='__PUBLIC__/js/jquery-1.7.2.min.js'></script>
</head>
<body>
	<form action="<?php echo U('runAddUser');?>" method='post'>
		<table class="table">
			<tr height='60'>
				<th colspan='2'>添加新用户</th>
			</tr>
			<tr>
				<td align='right' width='45%'>帐号：</td>
				<td>
					<input type="text" name='account'/>
				</td>
			</tr>
			<tr>
				<td align='right'>用户名：</td>
				<td>
					<input type="text" name='username'/>
				</td>
			</tr>
			<tr>
				<td align='right'>密码：</td>
				<td>
					<input type="password" name='password'/>
				</td>
			</tr>
			<tr>
				<td align='right'>确认密码：</td>
				<td>
					<input type="password" name='pwded'/>
				</td>
			</tr>
			<tr>
				<td colspan='2' align='center'>
					<input type="submit" value='保存添加' class='submit'/>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>