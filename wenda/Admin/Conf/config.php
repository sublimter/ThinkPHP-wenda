<?php
$config=array(
	'TMPL_PARSE_STRING' => array(
		'__PUBLIC__' => __ROOT__ . '/' . APP_NAME . '/Tpl/Public',
		),

);
return array_merge(include './Conf/config.php',$config);
?>