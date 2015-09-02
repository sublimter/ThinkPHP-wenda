<?php
/**
 * 会员中心里面提问视图模型
 */
Class AskViewModel extends ViewModel{
	protected $viewFields=array(
		'ask'=>array(
			'id','content','time','answer','reward',
			'_type'=>'LEFT'
			),
		'category'=>array(
			'name',
			'_on'=>'ask.cid=category.id'
			),
		);
}
?>