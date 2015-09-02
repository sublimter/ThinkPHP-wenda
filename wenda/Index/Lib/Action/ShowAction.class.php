<?php
/**
 * 问题展示控制器
 */
Class ShowAction extends CommonAction{
	//视图
	public function index(){
		$id=$this->_get('id','intval');
		$ask=D('AskInfoView')->find($id);
		if(!$ask){
			redirect(U('List/index'));
		}
		$ask['level']=exp_to_level($ask['exp']);
		$this->ask=$ask;
		//满意回答
		$where=array('aid'=>$id,'answer.adopt'=>1);
		$this->bingo=D('AnswerInfoView')->where($where)->find();
		//全部回答
		$where=array('answer.adopt'=>0,'aid'=>$id);
		import('ORG.Util.Page');
		$count=M('answer')->where($where)->count();
		$page=new Page($count,5);
		$limit=$page->firstRow.','.$page->listRows;
		$answer=D('AnswerInfoView')->where($where)->limit($limit)->select();
		// p($answer);die;
		$this->answer=$answer;
		$this->page=$page->show();
		//待解绝的问题
		$where=array('cid'=>$ask['cid'],'solve'=>0,'id'=>array('NEQ',$id));
		$wait=M('ask')->where($where)->limit(5)->select();
		$this->wait=$wait;

		$this->display();
	}
	//回答问题处理
	public function answer(){
		if(!$this->isPost()){
			halt('页面不存在');
		}
		$data=array(
			'content'=>$this->_post('content'),
			'time'=>time(),
			'aid'=>$this->_post('aid','intval'),
			'uid'=>session('uid')
			);
		$db=M('user');
		$where=array('id'=>$data['uid']);
		if(M('answer')->add($data)){
			//回答数加一
			M('ask')->where(array('id'=>$data['aid']))->setInc('answer');
			//用户回答数加一
			$db->where($where)->setInc('answer');
			//经验增加
			$db->where($where)->setInc('exp',C('LV_ANSWER'));
			//金币增加
			$db->where($where)->setInc('point',C('ANSWER'));
			$this->success('回答成功',$_SERVER['HTTP_REFERER']);
		}else{
			$this->error('提交失败');
		}
	}
	/*采纳处理*/
	public function adopt(){
		//answer表数据id
		$id=$this->_get('id','intval');
		//ask表数据id
		$aid=$this->_get('aid','intval');
		//uid
		$uid=$this->_get('uid','intval');
		$data=array(
			'id'=>$id,
			'adopt'=>1
			);
		//更新answer表中adopt字段
		if(M('answer')->save($data)){
			//更新ask表solve字段
			M('ask')->save(array('id'=>$aid,'solve'=>1));
			//该答案的用户adopt以及exp更新
			$db=M('user');
			$where=array('id'=>$uid);
			$db->where($where)->setInc('adopt');
			$db->where($where)->setInc('exp',C('LV_ADOPT'));//经验增加
			//金币的转让与转出
			$field=array('uid','reward');
			$reward=M('ask')->field($field)->find($aid);
			if($reward){
				$db->where(array('id'=>$reward['uid']))->setDec('point',$reward['reward']);
				$db->where(array('id'=>$uid))->setInc('point',$reward['reward']);
			}

			$this->success('采纳ok',$_SERVER['HTTP_REFERER']);
		}else{
			$this->error('更新失败');
		}
	}
}
?>