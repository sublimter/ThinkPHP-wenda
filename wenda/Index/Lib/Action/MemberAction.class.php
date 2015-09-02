<?php
/**
 * 会员中心
 */
Class MemberAction extends CommonAction{
	public function _initialize(){
		//分配角色
		$this->role=isset($_SESSION['uid']) && $id==session('uid') ? '我' : 'TA';
	}
	public function index(){
		$id=$this->_get('id','intval');
		//读取该用户信息
		$msg=M('user')->where(array('id'=>$id))->find();
		if(!$msg){
			//用户不存在
			$this->redirect('Index/index');
		}
		$this->msg=$msg;
		//我的提问
		$where=array('uid'=>$id);
		$this->myask=D('AskView')->where($where)->order('time DESC')->limit(5)->select();
		//我的回答
		$where=array('answer.uid'=>$id);
		$this->myAnswer=D('AnswerView')->where($where)->order('time DESC')->limit(5)->select();

		$this->display();
	}
	/**
	 * 我的提问
	 */
	public function myAsk(){
		$id=$this->_get('id','intval');
		//待解决问题
		$where=array('uid'=>$id,'solve'=>0);
		$myAsk=D('AskView')->where($where)->order('time DESC')->limit(5)->select();
		$this->myAsk=$myAsk;
		//以解决问题
		$where=array('uid'=>$id,'solve'=>1);
		$myAnswer=D('AskView')->where($where)->order('time DESC')->limit(5)->select();
		$this->myAnswer=$myAnswer;
		// p($myAnswer);
		$this->display();
	}
	/**
	 * 我的回答
	 */
	public function myAnswer(){
		//接受用户id
		$id=$this->_get('id','intval');
		//全部回答
		$where=array('answer.uid'=>$id);
		$this->myAnswer=D('AnswerView')->where($where)->order('time DESC')->select();
		//以采纳的回答
		$where=array('answer.uid'=>$id,'adopt'=>1);
		$this->count=D('AnswerView')->where($where)->count();
		
		$this->display();
	}
	/**
	 * 我的等级
	 */
	public function myLevel(){
		//接受用户id
		$id=$this->_get('id','intval');
		$this->exp=M('user')->where(array('id'=>$id))->getField('exp');
		$this->level=exp_to_level($this->exp);
		$this->display();
	}
	/**
	 * 我的金币
	 */
	public function myPoint(){
		//接受用户id
		$id=$this->_get('id','intval');

		$this->point=M('user')->where(array('id'=>$id))->getField('point');
		$this->display();
	}
	/**
	 * 我的头像
	 */
	public function myUpload(){
		//接受用户id
		$id=$this->_get('id','intval');
		$this->uid=$id;
		$this->display();
	}
	//处理上传头像
	public function domypic(){
		$uid=$this->_post('uid','intval');
		// p($uid);
		import('ORG.Net.UploadFile');
		$upload=new UploadFile();
		$upload->maxSize=1000000;
		$upload->allowExts=array('jpg','gif','png','jpeg');
		$upload->savePath='./Uploads/Face/';
		//缩率图片
		$upload->thumb=true;
		$upload->thumbMaxWidth='48';
		$upload->thumbMaxHeight='48';
		$upload->uploadReplace=true;
		$upload->thumbPrefix='wenda_';
		$upload->thumbRemoveOrigin=true;

		if(!$upload->upload()){
			$this->error($upload->getErrorMsg());
		}else{
			//上传成功
			$info=$upload->getUploadFileInfo();
			// p($info);
			//获取图片名称
			$face=$upload->thumbPrefix.$info[0]['savename'];
			// p($face);die;
			$data=array(
				'id'=>$uid,
				'face'=>$face
				);
			//更新数据
			M('user')->save($data);
			$this->success('上传成功',$_SERVER['HTTP_REFERER']);
		}

	}
}
?>