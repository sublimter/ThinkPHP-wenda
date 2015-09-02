<?php
/**
 * 自定义标签库
 */
import('TagLib');
Class TagLibDL extends TagLib{
	//自定义标签
	protected $tags=array(
		'topcates'=>array('attr'=>'limit'),
		'userinfo'=>array('attr'=>'uid'),
		'location'=>array('attr'=>'cid'),
		);
	//顶级分类读取标签
	public function _topcates($attr,$content){
		$attr=$this->parseXmlAttr($attr);
		$limit=isset($attr['limit']) ? $attr['limit'] : '';
		$str='<?php ';
		$str.='$where=array("pid"=>0);';
		$str.='$_topcatesResult=M("category")->where($where)->limit('. $limit .')->select();';
		$str.='foreach($_topcatesResult as $v) :';
		$str.='extract($v);?>';
		$str.=$content;
		$str.='<?php endforeach;?>';

		return $str;
	}
	//读取用户信息标签
	public function _userinfo($attr,$content){
		$attr=$this->parseXmlAttr($attr);
		$uid=$attr['uid'];
		//定界符
		$str=<<<str
<?php
	\$field=array('id','username','face','answer','adopt','ask','point','exp');
	\$_userinfoResult=M('user')->field(\$field)->find({$uid});
	extract(\$_userinfoResult);
	\$face=empty(\$face) ? '/Public/Images/noface.gif' : '/Uploads/Face/'.\$face;
	\$face=__ROOT__.\$face;
	\$adopt=round(\$adopt / \$answer*100,1) .'%';//四舍五入
	\$level=exp_to_level(\$exp);
?>
str;
		$str.=$content;
		return $str;
	}
	//获取当前所在分类位置
	public function _location($attr,$content){
		$attr=$this->parseXmlAttr($attr);
		$cid=$attr['cid'];
		$str=<<<str
<?php
	\$cid={$cid};
	if(S('location_'.\$cid)){
		\$_location_result=S('location_'.\$cid);
	}else{
		\$_location_cate=M('category')->select();
		\$_location_result=array_reverse(get_all_parents(\$_location_cate,\$cid));
		S('location_'.\$cid,\$_location_result,60);
	}
	foreach(\$_location_result as \$v) :
		extract(\$v);
?>
str;
		$str.=$content;
		$str.='<?php endforeach;?>';
		return $str;
	}
}
?>