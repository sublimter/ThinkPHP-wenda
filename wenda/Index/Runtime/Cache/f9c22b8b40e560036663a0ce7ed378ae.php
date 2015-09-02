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
	<link rel="stylesheet" href="__PUBLIC__/Css/index.css" />
	<script type="text/javascript" src='__PUBLIC__/Js/index.js'></script>
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

<!--------------------内容主体-------------------->
	<div class='main'>
		<div id='left'>
			<p class='left-title'>所有问题分类</p>
			<ul class='left-list'>
				<?php if(is_array($cate)): foreach($cate as $key=>$v): ?><li class='list-l1'>
						<div class='list-l1-wrap'>
							<h4><a href="<?php echo U('List/index', array('id' => $v['id']));?>"><?php echo ($v["name"]); ?></a></h4>
							<ul class='list-l2'>
								<!--先显示三个二级分类,使用thinkphp中的for循环标签-->
								<?php $__FOR_START_1885930566__=0;$__FOR_END_1885930566__=3;for($i=$__FOR_START_1885930566__;$i < $__FOR_END_1885930566__;$i+=1){ ?><li><a href="<?php echo U('List/index',array('id'=>$v['child'][$i]['id']));?>"><?php echo ($v['child'][$i]['name']); ?></a></li><?php } ?>
							</ul>
						</div>
						<!--多出来的先隐藏数据-->
						<div class='list-more hidden'>
							<ul>
								<?php $__FOR_START_1193121020__=3;$__FOR_END_1193121020__=count($v["child"]);for($i=$__FOR_START_1193121020__;$i < $__FOR_END_1193121020__;$i+=1){ ?><li><a href="<?php echo U('List/index', array('id' => $v['child'][$i]['id']));?>"><?php echo ($v['child'][$i]['name']); ?></a></li><?php } ?>
							</ul>
						</div>
					</li><?php endforeach; endif; ?>
			</ul>
		</div>

		<div id='center'>
			<div id='animate'>
				<div class='imgs-wrap'>
					<ul>
						<li>
							<a href=""><img src="__PUBLIC__/Images/animate1.png" width='558' height='190'/></a>
						</li>
						<!-- <li>
							<a href=""><img src="__PUBLIC__/Images/animate2.png" width='558' height='190'/></a>
						</li>
						<li>
							<a href=""><img src="__PUBLIC__/Images/animate3.png" width='558' height='190'/></a>
						</li> -->
					</ul>
				</div>
				<!-- <ul class='ani-btn'>
					<li class='ani-btn-cur'>问答系统网<i></i></li>
					<li>后盾网论坛<i></i> </li>
					<li style='border:none'>后盾网学习社区<i></i></li> 
				</ul> -->
			</div>

			<dl class='answer-list'>
				<dt>
					<span class='wait-as'>待解决问题</span>
					<a href=''>更多>></a>
				</dt>
				<?php if(is_array($wait)): foreach($wait as $key=>$v): ?><dd>
						<a href="<?php echo U('Show/index', array('id' => $v['id']));?>"><?php echo ($v["content"]); ?></a>
						<span><?php echo ($v["answer"]); ?>回答数</span>
					</dd><?php endforeach; endif; ?>
			</dl>

			<dl class='answer-list'>
				<dt>
					<span class='reward-as'>高分悬赏问题</span>
					<a href=''>更多>></a>
				</dt>
				<?php if(is_array($rewardAsk)): foreach($rewardAsk as $key=>$v): ?><dd>
						<a href="<?php echo U('Show/index', array('id' => $v['id']));?>"><b><?php echo ($v["reward"]); ?></b><?php echo ($v["content"]); ?></a>
						<span><?php echo ($v["answer"]); ?>回答</span>
					</dd><?php endforeach; endif; ?>
			</dl>

		</div>

<div id='right'>
	<?php if(!isset($_SESSION["uid"]) OR !isset($_SESSION["username"])): ?><div class='r-login'>
			<span class='login'><i></i>&nbsp;登录</span>
			<span class='register'><i></i>&nbsp;注册</span>
		</div>
	<?php else: ?>
	<!--读取用户信息标签-->
		<?php
 $field=array('id','username','face','answer','adopt','ask','point','exp'); $_userinfoResult=M('user')->field($field)->find($_SESSION["uid"]); extract($_userinfoResult); $face=empty($face) ? '/Public/Images/noface.gif' : '/Uploads/Face/'.$face; $face=__ROOT__.$face; $adopt=round($adopt / $answer*100,1) .'%'; $level=exp_to_level($exp); ?><div class='userinfo'>
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
				<ul>
					<li><a href="">我提问的</a></li>
					<li><a href="">我回答的</a></li>
				</ul>
			</div><?php endif; ?>

	<div class='clear'></div>
	<div class='star'>
		<p class='title'>问答之星</p>
		<span class='star-name'>本日回答最多的人</span>
		<!-- 原生php本日回答之星 -->
		<?php
 $todayTime=strtotime(date('y-m-d')); $sql='SELECT u.id AS id,username,face,exp,answer,u.adopt AS adopt FROM wd_answer a LEFT JOIN wd_user u ON a.uid=u.id WHERE time>'.$todayTime.' ORDER BY answer DESC LIMIT 1'; $answerOnDay=M()->query($sql); $starUser=$answerOnDay[0]; $starUser['level']=exp_to_level($starUser['exp']); ?>
			<div class='star-info'>
				<div>
					<a href="<?php echo U('Member/index', array('id' => $starUser['id']));?>" class='star-face'><img src="<?php if($starUser["face"]): ?>__ROOT__/Uploads/Face/<?php echo ($starUser["face"]); else: ?>__PUBLIC__/Images/noface.gif<?php endif; ?>" width='48px' height='48px'/></a>
					<ul>
						<li><a href="<?php echo U('Member/index', array('id' => $starUser['id']));?>"><?php echo ($starUser["username"]); ?></a></li>
						<li><i class='level lv<?php echo ($starUser["level"]); ?>' title='Level <?php echo ($starUser["level"]); ?>'></i></li>
					</ul>
				</div>
				<ul class='star-count'>
					<li>回答数：<span><?php echo ($starUser["answer"]); ?></span></li>
					<li>采纳率：<span><?php echo round($starUser['adopt']/$starUser['answer']*100,1);?>%</span></li>
				</ul>
			</div>
		<span class='star-name'>历史回答最多的人</span>
		<!-- 原生php历史回答 -->
		<?php
 $todayTime=strtotime(date('y-m-d')); $sql='SELECT id,username,face,exp,answer,adopt FROM wd_user ORDER BY answer DESC LIMIT 1'; $answerDay=M()->query($sql); $result=$answerDay[0]; $result['level']=exp_to_level($result['exp']); ?>
		<div class='star-info'>
			<div>
				<a href="<?php echo U('Member/index', array('id' => $result['id']));?>" class='star-face'><img src="<?php if($result["face"]): ?>__ROOT__/Uploads/Face/<?php echo ($result["face"]); else: ?>__PUBLIC__/Images/noface.gif<?php endif; ?>" width='48px' height='48px'/></a>
				<ul>
					<li><a href="<?php echo U('Member/index', array('id' => $result['id']));?>"><?php echo ($result["username"]); ?></a></li>
					<li><i class='level lv<?php echo ($result["level"]); ?>' title='Level <?php echo ($result["level"]); ?>'></i></li>
				</ul>
			</div>
			<ul class='star-count'>
				<li>回答数：<span><?php echo ($result["answer"]); ?></span></li>
				<li>采纳率：<span><?php echo round($result['adopt']/$result['answer']*100,1);?>%</span></li>
			</ul>
		</div>
	</div>


	
	<div class='star-list'>
		<p class='title'>问答助人光荣榜</p>
		<!-- 原生php -->
		<?php
 $todayTime=strtotime(date('y-m-d')); $sql='SELECT id,username,answer FROM wd_user ORDER BY answer DESC LIMIT 5'; $answerAll=M()->query($sql); ?>
		<div>
			<ul class='ul-title'>
				<li>用户名</li>
				<li style='text-align:right;'>帮助过的人数</li>
			</ul>
			<ul class='ul-list'>
				<?php if(is_array($answerAll)): foreach($answerAll as $key=>$v): ?><li>
						<a href="<?php echo U('Member/index', array('id' => $v['id']));?>"><i class='rank r<?php echo ($key + 1); ?>'></i><?php echo ($v["username"]); ?></a>
						<span><?php echo ($v["answer"]); ?></span>
					</li><?php endforeach; endif; ?>
			</ul>
		</div>
	</div>
</div>
	</div>
<!--------------------内容主体结束-------------------->
	<div class='clear'></div>
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