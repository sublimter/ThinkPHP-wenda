<?php
/**
 * 回答控制器
 */
Class AnswerAction extends CommonAction{
	// 全部/未采纳/采纳 回答
	public function index(){
		//判断条件(默认查询全部没有传filter参数，为null)
		$filter=isset($_GET['filter']) ? $_GET['filter'] : 0;
		$where=array();
		if($filter){
			$where['adopt']=$filter==1 ? 0 : 1;
		}
		import('ORG.Util.Page');
		$count=M('answer')->where($where)->count();
		$page=new Page($count,5);
		$limit=$page->firstRow.','.$page->listRows;
		$this->answer=M('answer')->where($where)->limit($limit)->select();
		$this->page=$page->show();
		$this->display();
	}
	//删除回答
	public function delAnswer(){
		//answer表中的id以及uid
		$id=$this->_get('id','intval');
		$uid=$this->_get('uid','intval');
		if(M('answer')->delete($id)){
			//金币处理
			M('user')->where(array('id'=>$uid))->setDec('point',C('DEL_ANSWER'));
			$this->success('ok！',U('index'));
		}else{
			$this->error('失败...');
		}
	}
}
?>