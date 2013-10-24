<?php 
	
	$conn = @mysql_connect('localhost','root','') or die("连接数据库失败！");
	@mysql_select_db('7k7k') or die("该数据库不存在！");
	mysql_query('SET names UTF8');

?>
