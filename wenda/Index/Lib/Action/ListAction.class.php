<?php
/**
 * 问题列表页控制器
 */
Class ListAction extends Action{
	public function index(){
		$id=$this->_get('id','intval');
		//分类列表
		$db=M('category');
		$cate=$db->where(array('pid'=>$id))->select();
		/*获取所有分类一位数组cid便于查询问题*/
		$cid=only_array($cate,'id');
		$cid[]=$id;//可能是一级分类id，也包含进来(自身分类id)
		//如果查不出来返回上级结果
		if(!$cate){
			$pid=$db->where(array('id'=>$id))->getField('pid');
			$cate=$db->where(array('pid'=>$pid))->select();
			//防止用户在地址栏上输入
			if(!$cate){
				$cate=$db->where(array('pid'=>0))->select();
				$cid=only_array($cate,'id');
			}
		}
		$this->cate=$cate;
		//问题列表
		$where=array('cid'=>array('IN',$cid));
		//组合筛选条件
		$filter=isset($_GET['filter']) ? $this->_get('filter','intval') : 0;
		switch($filter){
			case 1:
				$where['solve']=1;
				break;
			case 2:
			 	$where['reward']=array('GT',0);
			 	break;
			case 3:
				$where['answer']=0;
				break;
			default:
				$where['solve']=0;
		}
		//分页处理
		import('ORG.Util.Page');
		$count=M('ask')->where($where)->count('id');
		$page=new Page($count,5);
		$limit=$page->firstRow.','.$page->listRows;
		$db=D('AskView');
		$this->ask=$db->where($where)->order('time DESC')->limit($limit)->select();
		//echo $db->getLastSql();die;
		$this->page=$page->show();
		//id分配
		$this->cateid=$id;
		$this->filter=$filter;
		$this->display();
	}
	/**
	 * 问题搜索显示
	 */
	public function AskSerach(){
		$keyInfo = $_POST['keyinfo'];
		// echo $keyInfo;
		//模糊查询结果
		$where=array('content'=>array('like','%'.$keyInfo.'%'));
		//分页处理
		import('ORG.Util.Page');
		$count=M('ask')->where($where)->count('id');//定义处理数据表的方法
		$page=new Page($count,5);
		$limit=$page->firstRow.','.$page->listRows;
		//关联查询
		$db=D('AskView');
		$this->ask=$db->where($where)->order('time DESC')->limit($limit)->select();
		//echo $db->getLastSql();die;
		$this->page=$page->show();
		$this->display();
	}
}
?>