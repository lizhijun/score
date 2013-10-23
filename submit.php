<?php
	session_start();

	require_once "conn.php";

	$created = date("Y-m-d H:i:s" ,time()+3600*8);

	if(isset($_POST['token'])) {
		
		if($_POST['token'] == $_SESSION['token']){
			
			$sql = "UPDATE `score` SET `score`=`score`+".$_POST['score'].",`created`='".$created."' WHERE `id`=1 LIMIT 1";
			$query = mysql_query($sql);
			
			unset($_SESSION["token"]);       //将其清除掉此时再按F5则无效

			echo "提交成功！";

		}else{
			echo "请不要刷新本页面或重复提交表单";
		}
	}
	
	

	
?>