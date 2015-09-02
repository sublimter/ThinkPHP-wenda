<?php
/**
 * 展示页面回答视图模型
 */
Class AnswerInfoViewModel extends ViewModel{
	protected $viewFields=array(
		'answer'=>array(
			'id','content','time','adopt','aid',
			'_type'=>'LEFT'
			),
		'user'=>array(
			'id'=>'uid','username','face','exp','answer','adopt',
			'_on'=>'answer.uid=user.id'
			)
		);
}
?>