<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title><?php echo (C("webname")); ?></title>
	<meta name="keywords" content="<?php echo (C("keywords")); ?>"/>
	<meta name="description" content="<?php echo (C("description")); ?>"/>
	<link rel="stylesheet" href="__PUBLIC__/Css/common.css" />
	<script type="text/javascript" src='__PUBLIC__/Js/jquery-1.7.2.min.js'></script>
	<script type="text/javascript" src='__PUBLIC__/Js/top-bar.js'></script>
	<link rel="stylesheet" href="__PUBLIC__/Css/member.css" />
</head>
<body>
	<div id='top-fixed'>
	<div id='top-bar'>
		
		<ul class='top-bar-right fr'>
			<!--判断是否登录了-->
			<?php if(!isset($_SESSION["uid"]) OR !isset($_SESSION["username"])): ?><li><a href="" class='login'>登录</a></li>
				<li style='color:#eaeaf1'>|</li>
				<li><a href="" class='register'>注册</a></li>
			<?php else: ?>
				<li class='userinfo'>
					<a href="<?php echo U('Member/index', array('id' => $_SESSION['uid']));?>" class='uname'><?php echo (session('username')); ?></a>
				</li>
				<li style='color:#eaeaf1'>|</li>
				<li><a href="<?php echo U('Common/logout');?>">退出</a></li><?php endif; ?>
		</ul>
	</div>

	<div id='search'>
		<div class='logo'></div>
		<!-- 搜索问题答案的地方 -->
		<form action="<?php echo U('List/AskSerach');?>" method='POST'>
			<input type="text" name='keyinfo' class='sech-cons'/>
			<input type="submit" class='sech-btn'/>
		</form>
		<a href="<?php echo U('Ask/index');?>" class='ask-btn'></a>
	</div>
</div>
<div style='height:110px'></div>
<!----------导航条---------->
<div id='nav'>
	<ul class='list'>
		<li class='nav-sel'><a href="__APP__" class='home'>问答首页</a></li>
		<li class='nav-sel ask-cate'>
			<a href="<?php echo U('List/index');?>" class='ask-list'><span>问题分类</span><i></i></a>
			<ul class='hidden'>
				<!--顶级分类读取(使用自定义标签库)-->
				<?php $where=array("pid"=>0);$_topcatesResult=M("category")->where($where)->limit(10)->select();foreach($_topcatesResult as $v) :extract($v);?><li><a href="<?php echo U('List/index',array('id'=>$id));?>"><?php echo ($name); ?></a></li><?php endforeach;?>
			</ul>
		</li>
	</ul>
	<!-- <p class='total'>累计提问：10240000</p> -->
</div>
<!--判断已登录的不用加载下面的登录与注册框，减少加载-->
<?php if(!isset($_SESSION['uid']) OR !isset($_SESSION['username'])): ?><!--验证js-->
	<script type="text/javascript" src='__PUBLIC__/Js/validate.js'></script>
	<script type="text/javascript">
		var CONTROL = "__APP__/Common/";
	</script>
	<!----------注册框---------->
	<div id='register' class='hidden'>
		<div class='reg-title'>
			<p>欢迎注册问答系统</p>
			<a href="" title='关闭' class='close-window'></a>
		</div>
		<div id='reg-wrap'>
			<div class='reg-left'>
				<ul>
					<li><span>账号注册</span></li>
				</ul>
				<div class='reg-l-bottom'>
					已有账号，<a href="" id='login-now'>马上登录</a>
				</div>
			</div>
			<div class='reg-right'>
				<form action="<?php echo U('Common/register');?>" method='post' name='register'>
					<ul>
						<li>
							<label for="reg-account">账号</label>
							<input type="text" name='account' id='reg-account'/>
							<span>7-20个字符：以字母开头的字母、数字或下划线 _</span>
						</li>
						<li>
							<label for="reg-uname">用户名</label>
							<input type="text" name='username' id='reg-uname'/>
							<span>2-14个字符：字母、数字或中文</span>
						</li>
						<li>
							<label for="reg-pwd">密码</label>
							<input type="password" name='pwd' id='reg-pwd'/>
							<span>6-20个字符:字母、数字或下划线 _</span>
						</li>
						<li>
							<label for="reg-pwded">确认密码</label>
							<input type="password" name='pwded' id='reg-pwded'/>
							<span>请再次输入密码</span>
						</li>
						<li>
							<label for="reg-verify">验证码</label>
							<input type="text" name='verify' id='reg-verify'/>
							<img src="<?php echo U('Common/verify');?>" width='99' height='35' alt="验证码" id='verify-img'/>
							<span>请输入图中的字母或数字，不区分大小写</span>
						</li>
						<li class='submit'>
							<input type="submit" value='立即注册'/>
						</li>
					</ul>
				</form>
			</div>
		</div>
	</div>

	<!----------登录框---------->	
	<div id='login' class='hidden'>
		<div class='login-title'>
			<p>欢迎您登录问答系统</p>
			<a href="" title='关闭' class='close-window'></a>
		</div>
		<div class='login-form'>
			<span id='login-msg'></span>
			<form action="<?php echo U('Common/login');?>" method='post' name='login'>
				<ul>
					<li>
						<label for="login-acc">账号</label>
						<input type="text" name='account' class='input' id='login-acc'/>
					</li>
					<li>
						<label for="login-pwd">密码</label>
						<input type="password" name='pwd' class='input' id='login-pwd'/>
					</li>
					<li class='login-auto'>
						<label for="auto-login">
							<input type="checkbox" checked='checked' name='auto' id='auto-login'/>&nbsp;下一次自动登录
						</label>
						<a href="" id='regis-now'>注册新账号</a>
					</li>
					<li>
						<input type="submit" value='' id='login-btn'/>
					</li>
				</ul>
			</form>
		</div>
	</div><?php endif; ?>

<!--背景遮罩--><div id='background' class='hidden'></div>
<!--------------------中部-------------------->
	<div id='center'>
		<div id='left'>
	<!--使用userinfo标签-->
	<?php
 $field=array('id','username','face','answer','adopt','ask','point','exp'); $_userinfoResult=M('user')->field($field)->find($_GET["id"]); extract($_userinfoResult); $face=empty($face) ? '/Public/Images/noface.gif' : '/Uploads/Face/'.$face; $face=__ROOT__.$face; $adopt=round($adopt / $answer*100,1) .'%'; $level=exp_to_level($exp); ?><div class='userinfo'>
			<dl>
				<dt>
					<a href="<?php echo U('Member/index', array('id' => $id));?>"><img src="<?php echo ($face); ?>" width='48' height='48'/></a>
				</dt>
				<dd class='username'>
					<a href="<?php echo U('Member/index', array('id' => $id));?>"><b><?php echo ($username); ?></b><i class='level lv<?php echo ($level); ?>' title='Level <?php echo ($level); ?>'></i></a>
				</dd>
				<dd>金币：<a href="" style="color: #888888;"><b class='point'><?php echo ($point); ?></b></a></dd>
				<dd>经验值：<?php echo ($exp); ?></dd>
			</dl>
			<table>
				<tr>
					<td>回答数</td>
					<td>采纳率</td>
					<td class='last'>提问数</td>
				</tr>
				<tr>
					<td><a href=""><?php echo ($answer); ?></a></td>
					<td><a href=""><?php echo ($adopt); ?></a></td>
					<td class='last'><a href=""><?php echo ($ask); ?></a></td>
				</tr>
			</table>
		</div>
	<ul>
		<li class='myhome <?php if(ACTION_NAME == 'index'): ?>cur<?php endif; ?>'>
			<a href="<?php echo U('Member/index', array('id' => $_GET['id']));?>"><?php echo ($role); ?>的首页</a>
		</li>
		<li class='myask <?php if(ACTION_NAME == 'myAsk'): ?>cur<?php endif; ?>'>
			<a href="<?php echo U('Member/myAsk', array('id' => $_GET['id']));?>"><?php echo ($role); ?>的提问</a>
		</li>
		<li class='myanswer <?php if(ACTION_NAME == 'myAnswer'): ?>cur<?php endif; ?>'>
			<a href="<?php echo U('Member/myAnswer', array('id' => $_GET['id']));?>"><?php echo ($role); ?>的回答</a>
		</li>
		<li class='mylevel <?php if(ACTION_NAME == 'myLevel'): ?>cur<?php endif; ?>'>
			<a href="<?php echo U('Member/myLevel', array('id' => $_GET['id']));?>"><?php echo ($role); ?>的等级</a>
		</li>
		<li class='mypoint <?php if(ACTION_NAME == 'myPoint'): ?>cur<?php endif; ?>'>
			<a href="<?php echo U('Member/myPoint', array('id' => $_GET['id']));?>"><?php echo ($role); ?>的金币</a>
		</li>
		<?php if(isset($_SESSION["uid"]) && $_SESSION["uid"]==$_GET["id"]): ?><li class='mypoint <?php if(ACTION_NAME == 'myUpload'): ?>cur<?php endif; ?>'>
				<a href="<?php echo U('Member/myUpload', array('id' => $_GET['id']));?>"><?php echo ($role); ?>的头像</a>
			</li><?php endif; ?>
	</ul>
</div>
		<div id='right'>
			<p class='title'><?php echo ($role); ?>的首页</p>
			<ul class='property'>
				<li>金币：<span><?php echo ($msg["point"]); ?></span></li>
				<li>经验值：<span><?php echo ($msg["exp"]); ?></span></li>
				<li>采纳率：<span><?php echo round($msg['adopt'] / $msg['answer'] * 100, 1);?>%</span></li>
			</ul>
			<div class='list'>
				<p><span><?php echo ($role); ?>的提问 <b>(共<?php echo ($msg["ask"]); ?>条)</b></span><a href="">更多>></a></p>
				<table>
					<!--避免变量重名，如果是ask会不出结果，应为和mleft页面中ask重名了-->
					<?php if(!$myask): ?><tr height='140'>
							<td>你还没有进行过提问</td>
						</tr>
					<?php else: ?>
						<tr>
							<th class='t1'>标题</th>
							<th>回答</th>
							<th class='t3'>时间</th>
						</tr>
						<?php if(is_array($myask)): foreach($myask as $key=>$v): ?><tr>
								<td class='t1'>
									<a href="<?php echo U('Show/index',array('id'=>$v['id']));?>"><?php echo ($v["content"]); ?></a><span>[<?php echo ($v["name"]); ?>]</span>
								</td>
								<td><?php echo ($v["answer"]); ?></td>
								<td class='t3'><?php echo (time_to_format($v["time"])); ?></td>
							</tr><?php endforeach; endif; endif; ?>
				</table>
			</div>
			<div class='list'>
				<p><span><?php echo ($role); ?>的回答 <b>(共<?php echo ($msg["answer"]); ?>条)</b></span><a href="">更多>></a></p>
				<table>
					<?php if(!$myAnswer): ?><tr height='140'>
							<td>你还没有进行过回答</td>
						</tr>
					<?php else: ?>
						<tr>
							<th class='t1'>标题</th>
							<th>回答</th>
							<th class='t3'>更新时间</th>
						</tr>
						<?php if(is_array($myAnswer)): foreach($myAnswer as $key=>$v): ?><tr>
								<td class='t1'>
									<a href="<?php echo U('Show/index', array('id' => $v['id']));?>"><?php echo ($v["content"]); ?></a><span>[<?php echo ($v["name"]); ?>]</span>
								</td>
								<td><?php echo ($v["answer"]); ?></td>
								<td class='t3'><?php echo (time_to_format($v["time"])); ?></td>
							</tr><?php endforeach; endif; endif; ?>
				</table>
			</div>
		</div>
	</div>
<!--------------------中部结束-------------------->

<!--------------------底部-------------------->
	<div id='bottom'>
		<p><?php echo (C("copy")); ?></p>
		<p><?php echo (C("record")); ?></p>
	</div>
<!--[if IE 6]>
    <script type="text/javascript" src="__PUBLIC__/Js/iepng.js"></script>
    <script type="text/javascript">
    	DD_belatedPNG.fix('.logo','background');
        DD_belatedPNG.fix('.nav-sel a','background');
        DD_belatedPNG.fix('.ask-cate i','background');
    </script>
<![endif]-->
</body>
</html>