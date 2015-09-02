<?php
/**
 * 后台首页控制器
 */
class IndexAction extends CommonAction {
    /*后台首页视图*/
    public function index(){
		$this->display();
	}
	/*获取信息*/
	public function copy(){
		$this->time=time();
		$this->ip=get_client_ip();
		$this->username=$_SESSION['username'];
		$this->loginip=$_SESSION['loginip'];
		$this->logintime=$_SESSION['logintime'];
		$this->display();	
	}
}