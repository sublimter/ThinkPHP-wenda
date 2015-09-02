<?php
/**
 * 问题列表控制器
 */
Class AskAction extends CommonAction{
	//全部问题视图
	public function index(){
		//分页
		import('ORG.Util.Page');
		$count=M('ask')->count();
		$page=new Page($count,5);
		$limit=$page->firstRow.','.$page->listRows;
		$this->ask=M('ask')->order('time DESC')->limit($limit)->select();
		$this->page=$page->show();

		$this->display();
	}
	//待解决问题
	public function wait(){
		//分页
		import('ORG.Util.Page');
		$count=M('ask')->count();
		$page=new Page($count,5);
		$limit=$page->firstRow.','.$page->listRows;
		$this->ask=M('ask')->where(array('solve'=>0))->order('time DESC')->limit($limit)->select();
		$this->page=$page->show();

		$this->display('index');
	}
	//已解决问题
	public function solve(){
		//分页
		import('ORG.Util.Page');
		$count=M('ask')->count();
		$page=new Page($count,5);
		$limit=$page->firstRow.','.$page->listRows;
		$this->ask=M('ask')->where(array('solve'=>1))->order('time DESC')->limit($limit)->select();
		$this->page=$page->show();
		$this->display('index');
	}
	//零回答问题
	public function zero(){
		//分页
		import('ORG.Util.Page');
		$count=M('ask')->count();
		$page=new Page($count,5);
		$limit=$page->firstRow.','.$page->listRows;
		$this->ask=M('ask')->where(array('answer'=>0))->order('time DESC')->limit($limit)->select();
		$this->page=$page->show();
		$this->display('index');
	}
	//删除问题
	public function delAsk(){
		$aid=$this->_get('id','intval');
		$askinfo=M('ask')->field(array('uid','solve'))->find($aid);
		/*关联删除answer与ask表*/
		if(D('AskRelation')->relation(true)->delete($aid)){
			$db=M('user');
			$db->where(array('id'=>$askinfo['uid']))->setDec('point',C('DEL_ASK'));
			//该问题是否被解决
			if($askinfo['solve']){
				$where=array('aid'=>$aid,'adopt'=>1);
				$answerUid=M('answer')->where($where)->getField('uid');
				//金币处理
				$db->where(array('id'=>$answerUid))->setDec('point',C('DEL_ADOPT_ANSWER'));
				$db->where(array('id'=>$askinfo['uid']))->setDec('point',C('DEL_ADOPT_ASK'));
			}
			$this->success('删除成功',U('index'));
		}else{
			$this->error('删除失败');
		}
	}
}
?>