<?php
/**
 * 共用的控制器
 */
Class CommonAction extends Action{
	//自动运行的方法
	public function _initialize(){
		//检测是否登录
		if(!isset($_SESSION['uid'])){
			$this->redirect('Login/index');
		}
	}
}
?>