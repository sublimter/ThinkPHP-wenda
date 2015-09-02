<?php
/**
 * 用户控制器
 */
Class UserAction extends CommonAction{
	//(禁止)用户列表
	public function index(){
		import('ORG.Util.Page');
		//接受过滤条件
		$filter=isset($_GET['filter']) ? $_GET['filter'] : 0;
		$where=array();
		if($filter){
			$where['lock']=$filter==1 ? 1 : 0;
		}
		//读取用户信息
		$count=M('user')->where($where)->count();
		$page=new Page($count,5);
		$limit=$page->firstRow.','.$page->listRows;
		$this->user=M('user')->where($where)->limit($limit)->select();
		$this->page=$page->show();
		$this->display();
	}
	//添加用户
	public function addUser(){
		$this->display();
	}
	//处理添加用户
	public function runAddUser(){
		$account=$this->_post('account');
		$username=$this->_post('username');
		$password=$this->_post('password','md5');
		if($password!=$this->_post('pwded','md5')){
			$this->error('两次密码不一致');
		}
		$data=array(
			'account'=>$account,
			'password'=>$password,
			'username'=>$username,
			'logintime'=>time(),
			'loginip'=>get_client_ip(),
			'registime'=>time()
			);
		//用户名或帐号不能重复
		$db=M('user');
		$user=$db->where(array('account'=>$account))->select();
		if(!$user){
			M('user')->add($data);
			$this->success('添加成功',U('index'));
		}else{
			$this->error('帐号重复，不可用...');
		}
	}
	//解除/锁定用户
	public function lockUser(){
		$id=$this->_get('id','intval');
		$lock=$this->_get('lock','intval');
		$msg=$lock ? '锁定' : '解锁';
		$data=array(
			'id'=>$id,
			'lock'=>$lock
			);
		if(M('user')->save($data)){
			$this->success($msg.'成功',U('index'));
		}else{
			$this->error($msg.'失败');
		}
	}
}
?>