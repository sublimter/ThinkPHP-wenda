<?php
/**
 * 格式化打印数组
 */
function p($arr){
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
}
/**
 * 无限极分类数组(一维数组)
 * 参数：原数组，初始父级id，每个分类的等级(用与显示缩进效果)，html--缩进符号
 */
function levelArray($array,$pid=0,$level=0){
	$arr=array();
	foreach($array as $v){
		if($v['pid']==$pid){
			$v['level']=$level;
			$v['html']=str_repeat('---', $level);
			$arr[]=$v;
			$arr=array_merge($arr,levelArray($array,$v['id'],$level+1));
		}
	}
	return $arr;
}
/**
 * 通过pid获取子类所有id
 */
function getChildsID($array,$pid){
	$cids=array();
	foreach($array as $v){
		if($v['pid']==$pid){
			$cids[]=$v['id'];
			$cids=array_merge($cids,getChildsID($array,$v['id']));
		}
	}
	return $cids;
}
?>