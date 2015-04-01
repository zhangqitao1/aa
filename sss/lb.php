<?php

require './source/class/class_core.php';//引入系统核心文件
$discuz = & discuz_core::instance();//以下代码为创建及初始化对象
$discuz->init();    
$tid=$_GET['tid']?intval($_GET['tid']):0;

 dd

$cooname='Lb-'.$tid;
$lbm=getcookie($cooname);
if(!$lbm) {

	 
	$db = DB::object();
	$query = $db->query("SELECT texts from lbms where tid=$tid  ");
	$row=$db->fetch_array($query); 
	if($row['texts']) {
		$rows = explode("\r\n", $row['texts']);
		$lbm=$rows[0]; 
        unset($rows[0]);
		$str=implode("\r\n",$rows); 
		$count=count($rows);
		$db->query("update lbms set texts='".$str."',count=".$count." where tid=$tid ");
	}
	else{
	    $lbm='礼包码没有了，请给楼主留言吧';
	} 
	
	dsetcookie($cooname,$lbm, 3600*24*30);  
} 
 include template('common/lb');//调用单页模版文件
 exit;

?> 
