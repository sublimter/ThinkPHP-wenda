<?php
/**
 * 问题详细视图模型
 */
Class AskInfoViewModel extends ViewModel{
	protected $viewFields=array(
		'ask'=>array(
			'id','content','reward','solve','time','cid','answer',
			'_type'=>'LEFT'
			),
		'user'=>array(
			'id'=>'uid','username','exp',
			'_on'=>'ask.uid=user.id'
			)
		);
}
?>