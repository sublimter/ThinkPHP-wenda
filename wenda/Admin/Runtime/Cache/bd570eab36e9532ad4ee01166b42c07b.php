<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="__PUBLIC__/css/public.css" />
</head>
<body>
	<!--同样写入到配置文件中-->
	<form action="<?php echo U('Reward/edit');?>" method='post'>
		<table class="table">
			<tr>
				<th colspan='2'>网站设置</th>
			</tr>
			<tr>
				<td width='45%' align='right'>网站名称：</td>
				<td>
					<input type="text" name='webname' value='<?php echo (C("webname")); ?>'/>
				</td>
			</tr>
			<tr>
				<td align='right'>网站关键词：</td>
				<td>
					<input type="text" name='keywrods' value='<?php echo (C("keywrods")); ?>' class='len400'/>
				</td>
			</tr>
			<tr>
				<td align='right'>网站描述：</td>
				<td>
					<input type="text" name='discription' value='<?php echo (C("discription")); ?>' class='len400'/>
				</td>
			</tr>
			<tr>
				<td align='right'>版权信息</td>
				<td>
					<input type="text" name='copy' value='<?php echo (C("copy")); ?>' class='len400'/>
				</td>
			</tr>
			<tr>
				<td align='right'>备案号：</td>
				<td>
					<input type="text" name='record' value='<?php echo (C("record")); ?>' class='len400'/>
				</td>
			</tr>
			<tr>
				<td align='right'>是否开放注册：</td>
				<td>
					<label for="r1">
						<input type="radio" id='r1' value='1' name='regis_on' <?php if(C("regis_on")): ?>checked='checked'<?php endif; ?>/>&nbsp;开放
					</label>&nbsp;&nbsp;
					<label for="r0">
						<input type="radio" id='r0' value='0' name='regis_on' <?php if(!C("regis_on")): ?>checked='checked'<?php endif; ?>/>&nbsp;关闭
					</label>
				</td>
			</tr>
			<tr>
				<td align='right'>网站状态：</td>
				<td>
					<label for="o1">
						<input type="radio" id='o1' name='web_state' value='1' <?php if(C("web_state")): ?>checked='checked'<?php endif; ?>/>&nbsp;开放
					</label>&nbsp;&nbsp;
					<label for="o0">
						<input type="radio" id='o0' name='web_state' value='0' <?php if(!C("web_state")): ?>checked='checked'<?php endif; ?>/>&nbsp;维护中
					</label>
				</td>
			</tr>
			<tr>
				<td colspan='2' align='center' height='60'>
					<input type="submit" value='保存修改' class='submit'/>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>