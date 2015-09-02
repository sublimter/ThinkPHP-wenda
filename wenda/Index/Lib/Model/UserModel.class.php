<?php
/**
 * 用户表操作模型
 */
Class UserModel extends Model{
	//字段映射(与数据库中字段不一致的),不用担心前台字段不一致的问题
	protected $_map=array(
		'pwd'=>'password'
		);
	//自动验证
	protected $_validate=array(
		array('account','require','帐号不能为空'),
		array('account','/^[a-zA-Z]\w{4,15}$/s','帐号格式不正确',1,'regex'),
		array('account','','帐号已存在',1,'unique'),
		array('username','require','用户名不能为空'),
		//array('username','/^\w{2,14}$/s','用户名格式不正确',1,'regex'),
		array('username','','用户名已存在',1,'unique'),
		array('password','require','密码不能为空'),
		array('password','/^\w{5,20}$/s','密码格式不正确',1,'regex'),
		array('pwded','password','两次密码不一致',1,'confirm')
		);
	//自动完成
	protected $_auto=array(
		array('password','md5',1,'function'),
		array('logintime','time',1,'function'),
		array('loginip','get_client_ip',1,'function'),
		array('registime','time',1,'function')
		);
}
?>