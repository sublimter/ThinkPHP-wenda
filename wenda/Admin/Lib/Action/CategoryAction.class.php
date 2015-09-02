<?php
/**
 * 问题分类控制器
 */
Class CategoryAction extends CommonAction{
	/*问题列表视图*/
	public function index(){
		//读取分类数据
		$cate=M('category')->select();
		$cate=levelArray($cate);
		
		$this->cate=$cate;
		$this->display();
	}
	/*添加顶级分类*/
	public function addTop(){
		$this->display();
	}
	//处理添加分类
	public function addCate(){
		//获取数据
		$name=$this->_post('name');
		$pid=$this->_post('pid','intval');
		$data=array(
			'name'=>$name,
			'pid'=>$pid
			);
		if(M('category')->add($data)){
			$this->success('添加成功',U('Category/index'));
		}else{
			$this->error('添加失败');
		}
	}
	/*添加子分类*/
	public function addChild(){
		//接受父级pid
		$pid=$this->_get('pid','intval');
		$cate=M('category')->where(array('id'=>$pid))->find();
		$this->cate=$cate;
		$this->display();
	}
	/*删除分类*/
	public function del(){
		/*删除该分类以及下面的子分类*/
		$id=$this->_get('id');
		$cate=M('category')->field(array('id','pid'))->select();
		//获取该父级id下的所有子类id号
		$cids=getChildsID($cate,$id);
		$cids[]=$id;
		$where=array('id'=>array('IN',$cids));

		if(M('category')->where($where)->delete()){
			$this->success('删除分类成功',U('index'));
		}else{
			$this->error('删除失败');
		}
	}
	//修改分类信息
	public function edit(){
		$id=$this->_get('id','intval');
		//查询出数据并分配到模版中
		$cate=M('category')->where(array('id'=>$id))->find();
		$this->cate=$cate;
		$this->display();
	}
	//处理修改分类
	public function editCate(){
		$id=$this->_post('id','intval');
		$name=$this->_post('name');
		$data=array(
			'id'=>$id,
			'name'=>$name
			);
		//修改数据(数据中包含主键id,可以直接save不用where)
		if(M('category')->save($data)){
			$this->success('修改成功',U('Category/index'));
		}else{
			$this->error('修改失败');
		}
	}
}
?>