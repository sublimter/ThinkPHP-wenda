<?php
/**
 * 前台首页控制器
 */
class IndexAction extends CommonAction {
   	/*首页试图*/
    public function index(){
    	if(S('cate_index')){
    		$cate=S('cate_index');
    	}else{
	    	//读取顶级分类
	    	$db=M('category');
	    	$cate=$db->where(array('pid'=>0))->select();
	    	/*组合二级分类数据*/
	    	foreach($cate as $k=>$v){
	    		$cate[$k]['child']=$db->where(array('pid'=>$v['id']))->select();
	    	}
	    	S('cate_index',$cate,60);
    	}
    	$this->cate=$cate;
    	//待解决的问题
    	$db=M('ask');
    	$where=array('solve'=>0,'reward'=>0);
    	$this->wait=$db->where($where)->limit(5)->select();
    	//高悬赏问题
    	$where=array('solve'=>0,'reward'=>array('GT',0));
    	$this->rewardAsk=$db->where($where)->limit(5)->select();

		$this->display();
	}
}