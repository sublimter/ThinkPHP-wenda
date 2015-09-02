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
	<link rel="stylesheet" href="__PUBLIC__/Css/ask.css" />
	<script type="text/javascript" src='__PUBLIC__/Js/send.js'></script>
	<script type="text/javascript">
		var getCate = '<?php echo U("getCate");?>';
		var on = false;
		var point = 0;//用户金币，默认没有登录时是 0 
		//判断是否已登录
		<?php if(isset($_SESSION["uid"]) && isset($_SESSION["username"])): ?>on = true;
			point = <?php echo ($point); ?>;<?php endif; ?>
	</script>
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
	<div id='location'>
		<a href="__APP__">问答系统</a>&nbsp;>&nbsp;提问
	</div>

<!--------------------中部-------------------->
	<div id='center'>
		<div class='send'>
			<div class='title'>
				<p class='left'>向网友们提问</p>
				<p class='right'>您还可以输入<span id='num'>50</span>个字</p>
			</div>
			<form action="<?php echo U('send');?>" method='post'>
				<div class='cons'>
					<textarea name="content"></textarea>
				</div>
				<div class='reward'>
					<span id='sel-cate' class='cate-btn'>选择分类</span>
					<ul>
						<li>
							<?php if(isset($_SESSION["uid"]) && isset($_SESSION["username"])): ?>我的金币：<span><?php echo ($point); ?></span><?php endif; ?>
						</li>
						<li>
							悬赏：<select name="reward">
								<option value="0">0</option>
								<option value="5">5</option>
								<option value="10">10</option>
								<option value="15">15</option>
								<option value="20">20</option>
								<option value="30">30</option>
								<option value="50">50</option>
								<option value="80">80</option>
								<option value="100">100</option>
							</select>金币
						</li>
					</ul>
				</div>
				<!--把获取的分类id保存在这个隐藏域以便于提交过去-->
				<input type='hidden' name='cid' value='0'/>
				<input type="submit" value='提交问题' class='send-btn'/>
			</form>
		</div>
	</div>
	<div id='category'>
		<p class='title'>
			<span>请选择分类</span>
			<a href="" class='close-window'></a>
		</p>
		<div class='sel'>
			<p>选择一个合适的分类：</p>
			<select name="cate-one" size='16'>
				<?php if(is_array($cate)): foreach($cate as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
			</select>
			<select name="cate-one" size='16' class='hidden'></select>
			<select name="cate-one" size='16' class='hidden'></select>
		</div>
		<p class='bottom'>
			<span id='ok'>确定</span>
		</p>
	</div>
<!--------------------中部结束-------------------->

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