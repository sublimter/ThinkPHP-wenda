<?php
/**
 * 提问控制器
 */
Class AskAction extends CommonAction{
	//提问视图
	public function index(){
		//顶级分类
		$this->cate=M('category')->where(array('pid'=>0))->select();

		if(isset($_SESSION['uid']) && isset($_SESSION['username'])){
			$this->point=M('user')->where(array('id'=>$_SESSION['uid']))->getField('point');
		}

		$this->display();
	}
	//提交问题
	public function send(){
		if(!$this->isPost()){
			halt('页面不存在');
		}
		$data=array(
			'content'=>$this->_post('content'),
			'reward'=>$this->_post('reward','intval'),
			'time'=>time(),
			'uid'=>session('uid'),
			'cid'=>$this->_post('cid','intval')
			);
		if($aid=M('ask')->add($data)){
			//提问数加一，经验值加一
			$where=array('id'=>session('uid'));
			$db=M('user');
			$db->where($where)->setInc('ask');
			$db->where($where)->setInc('exp',C('LV_ASK'));
			//跳转到用户中心
			redirect(U('Member/index',array('id'=>session('uid'))));
		}else{
			$this->error('提问失败');
		}
	}
	//异步获取分类
	public function getCate(){
		if(!$this->isAjax()){
			halt('页面不存在');
		}
		$pid=$this->_get('pid','intval');
		$where=array('pid'=>$pid);
		if($cate=M('category')->where($where)->select()){
			echo json_encode($cate);
		}else{
			echo 0;
		}
	}
}
?>