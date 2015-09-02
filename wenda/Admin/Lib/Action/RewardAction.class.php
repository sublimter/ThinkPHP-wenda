<?php
/**
 * 金币奖励规则
 */
Class RewardAction extends CommonAction{
	//金币奖励试图
	public function index(){
		$this->display();
	}
	//处理 金币/经验/网站设置 规则保存
	public function edit(){
		$config=include './Conf/config.php';
		//把同名的配置项覆盖即可
		$config=array_merge($config,array_change_key_case($_POST,CASE_UPPER));
		//写入文件(thinkphp方法)
		if(F('config',$config,'./Conf/')){
			$this->success('写入成功',$_SERVER['HTTP_REFERER']);
		}else{
			$this->error('写入失败');
		}
	}
	//经验级别视图
	public function level(){
		$this->display();
	}
}
?>