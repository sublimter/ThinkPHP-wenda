<?php
/**
 * 公用的控制器
 */
Class CommonAction extends Action{
	//初始化方法
	public function _initialize(){
		//判断网站是否处于维护中
		if(!C('WEB_STATE')){
			halt('网站处于维护中');
		}
		//检测是否有自动登录(是在没有登录的情况下)
		if(isset($_COOKIE['auto']) && !isset($_SESSION['uid'])){
			$value=explode('|',encrytion($_COOKIE['auto'],0));
			//检测ip是否一致
			if($value[1]==get_client_ip()){
				session('uid',$value[0]);
				session('username',$value[2]);
			}
		}
	}
	//注册
	public function register(){
		if(!$this->isPost()){
			halt('页面不存在');
		}
		/*使用自动验证以及自动完成*/
		$db=D('User');
		if(!$db->create()){
			$this->error($db->getError());
		}
		//从自动验证对象中获取username
		$username=$db->username;

		if($uid=$db->add()){
			//写入信息到session
			session('uid',$uid);
			session('username',$username);
			$this->success('注册成功',U('Index/index'));
		}else{
			$this->error('注册失败');
		}
		
	}
	//异步验证帐号
	public function checkAccount(){
		if(!$this->isAjax()){
			halt('页面不存在');
		}
		$account=$this->_post('account');
		$where=array('account'=>$account);
		if(M('user')->where($where)->find()){
			echo 0;
		}else{
			echo 1;
		}
	}
	//异步验证用户名
	public function checkUsername(){
		if(!$this->isAjax()){
			halt('页面不存在');
		}
		$username=$this->_post('username');
		$where=array('username'=>$username);
		if(M('user')->where($where)->find()){
			echo 0;
		}else{
			echo 1;
		}
	}
	//异步验证验证码
	public function checkVerify(){
		if(!$this->isAjax()){
			halt('页面不存在');
		}
		$verify=$this->_post('verify');
		if(md5($verify)!=$_SESSION['verify']){
			echo 0;
		}else{
			echo 1;
		}
	}
	//异步验证登录帐号与密码
	public function checkLogin(){
		if(!$this->isAjax()){
			halt('页面不存在');
		}
		$account=$this->_post('account');
		$where=array('account'=>$account);
		if(!$pwd=M('user')->where($where)->getField('password')){
			echo 0;
		}else{
			if($pwd!=$this->_post('password','md5')){
				echo 0;
			}else{
				echo 1;
			}
		}
	}
	/*登录*/
	public function login(){
		if(!$this->isPost()){
			halt('页面不存在');
		}
		$db=M('user');
		$field=array('id','username','password','logintime','lock');
		$where=array('account'=>$this->_post('account'));
		$user=$db->where($where)->field($field)->find();
		if(!$user || $user['password']!=$this->_post('pwd','md5')){
			$this->error('帐号或密码错误');
		}
		if($user['lock']){
			$this->error('帐号被锁定');
		}
		//是否下次自动登录
		if(isset($_POST['auto'])){
			//设置cookie并加密
			$value=$user['id'].'|'.get_client_ip().'|'.$user['username'];
			$value=encrytion($value,1);//加密数据
			//写入数据
			@setcookie('auto',$value,C('AUTO_LOGIN_LIFETIME'),'/');
		}
		/*每天登录获得经验*/
		$today=strtotime(date('Y-m-d'));//今天0时0分0秒
		$where=array('id'=>$user['id']);
		if($user['logintime'] < $today){
			$db->where($where)->setInc('exp',C('LV_LOGIN'));
		}
		//更新时间
		$db->where($where)->save(array('logintime'=>time()));
		//写入session信息
		session('uid',$user['id']);
		session('username',$user['username']);

		redirect($_SERVER['HTTP_REFERER']);
	}
	//退出登录
	public function logout(){
		session_unset();
		session_destroy();
		@setcookie('auto','',C('AUTO_LOGIN_LIFETIME'),'/');
		$this->redirect('Index/index');
	}
	//验证码
	public function verify(){
		import('ORG.Util.Image');
		Image::buildImageVerify(4,1,'png');
	}
}
?>