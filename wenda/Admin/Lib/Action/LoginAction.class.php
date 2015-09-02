<?php
/**
 * 后台登录控制器
 */
Class LoginAction extends Action{
	/*登录视图*/
	public function index(){
		$this->display();
	}
	/*
		登录处理方法
	*/
	public function login(){
		if(!IS_POST){
			halt('页面不存在');
		}
		$account=$this->_post('username');
		$password=$this->_post('password');
		$code=$this->_post('code');
		//验证码判断
		if(md5($code)!=$_SESSION['verify']){
			$this->error('验证码错误');
		}
		$user=M('admin')->where(array('account'=>$account))->find();
		if(!$user || $user['password']!=md5($password)){
			$this->error('用户名或密码错误');
		}
		//更新登录ip以及时间
		$data=array(
			'id'=>$user['id'],
			'logintime'=>time(),
			'loginip'=>get_client_ip()
			);
		M('admin')->save($data);

		//验证通过后相关信息写入到session
		session('uid',$user['id']);
		session('username',$user['account']);
		session('logintime',$user['logintime']);
		session('loginip',$user['loginip']);

		$this->redirect('Index/index');
	}
	//验证码
	public function verify(){
		import('ORG.Util.Image');
		Image::buildImageVerify(4,3,'png');
	}
	/*
	退出登陆
	*/
	public function logout(){
		session_unset();
		session_destroy();
		//跳转到登录页面
		$this->redirect('Login/index');
	}
}
?>