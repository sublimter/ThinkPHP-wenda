<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/index.js"></script>
<link rel="stylesheet" href="__PUBLIC__/css/public.css" />
<link rel="stylesheet" href="__PUBLIC__/css/index.css" />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<base target="iframe"/>
<head>
</head>
<body>
	<div id="top">
		<div class="menu">
			<a href="<?php echo U('Ask/index');?>">查看问题</a>
			<a href="<?php echo U('Answer/index');?>">查看回答</a>
			<a href="<?php echo U('Category/index');?>">所有分类</a>
			<a href="<?php echo U('Reward/index');?>">奖励规则</a>
			<a href="<?php echo U('User/index');?>">网站用户</a>
			<a href="<?php echo U('System/index');?>">系统设置</a>
			<a href="#">查看首页</a>
		</div>
		<div class="exit">
			<a href="<?php echo U('Login/logout');?>" target="_self">退出</a>
		</div>
	</div>
	<div id="left">
		<dl>
			<dt>问题管理</dt>
			<dd><a href="<?php echo U('Ask/index');?>">所有问题</a></dd>
			<dd><a href="<?php echo U('Ask/wait');?>">待解决问题</a></dd>
			<dd><a href="<?php echo U('Ask/solve');?>">已解决问题</a></dd>
			<dd><a href="<?php echo U('Ask/zero');?>">零回答问题</a></dd>
		</dl>
		<dl>
			<dt>回答管理</dt>
			<dd><a href="<?php echo U('Answer/index');?>">所有回答</a></dd>
			<dd><a href="<?php echo U('Answer/index', array('filter' => 1));?>">未采纳回答</a></dd>
			<dd><a href="<?php echo U('Answer/index', array('filter' => 2));?>">已采纳回答</a></dd>
		</dl>
		<dl>
			<dt>问题分类管理</dt>
			<dd><a href="<?php echo U('Category/index');?>">问题分类列表</a></dd>
			<dd><a href="<?php echo U('Category/addTop');?>">添加顶级分类</a></dd>
		</dl>
		<dl>
			<dt>奖励管理</dt>
			<dd><a href="<?php echo U('Reward/index');?>">金币奖励规则</a></dd>
			<dd><a href="<?php echo U('Reward/level');?>">经验级别规则</a></dd>
		</dl>
		<dl>
			<dt>用户管理</dt>
			<dd><a href="<?php echo U('User/index');?>">用户列表</a></dd>
			<dd><a href="<?php echo U('User/addUser');?>">添加新用户</a></dd>
			<dd><a href="<?php echo U('User/index', array('filter' => 1));?>">已禁止用户</a></dd>
		</dl>
		<dl>
			<dt>系统设置</dt>
			<dd><a href="<?php echo U('System/index');?>">网站设置</a></dd>
		</dl>
	</div>
	<div id="right">
		<iframe name="iframe" src="<?php echo U('copy');?>"></iframe>
	</div>
</body>
</html>