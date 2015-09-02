<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
</head>
<body>
		<p>用户名:<?php echo ($username); ?></p>
		<p>上一次登录时间:<?php echo (date('Y-m-d H:i',$logintime)); ?></p>
		<p>本次登录时间:<?php echo (date('Y-m-d H:i',$time)); ?></p>
		<p>上一次登录IP:<?php echo ($loginip); ?></p>
		<p>本次登录IP:<?php echo ($ip); ?></p>
</body>
</html>