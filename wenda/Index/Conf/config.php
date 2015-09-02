<?php
$config=array(
	//加载自定义标签库
	'TAGLIB_LOAD'=>TRUE,
	'APP_AUTOLOAD_PATH'=>'@.TagLib',
	'TAGLIB_BUILD_IN'=>'Cx,DL',
	//异位或加密key值
	'AUTO_LOGIN_KEY'=>'luodaliang.com',
	//有效时间
	'AUTO_LOGIN_LIFETIME'=>time()+3600,
);
return array_merge(include './Conf/config.php',$config);
?>