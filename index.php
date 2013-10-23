<?php
	session_start();                //根据当前SESSION生成随机数
	$token = mt_rand(0,1000000);
	$_SESSION['token'] = $token;      //将此随机数暂存入到session

	require_once "conn.php";

	$sql = "SELECT `score` FROM `score` WHERE `id`=1 ";
	$query = mysql_query($sql);
	$rs = mysql_fetch_array($query);
?>
<!DOCTYPE html>
<html>
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>7k7k - 面试题</title>
	<style type="text/css">	
		#center {
			margin:10% 30%;
		}
	</style>
  </head>
  <body>
    <div id="center">
	  <label for="score">随机生成的积分：</label>
	  <input type="text" id="score" value="20" />
	  <input type="hidden" id="token" value="<?php echo $token;?>" />
	  <input type="submit" value="提交积分" />
	  
	  <br />
	  <br />
	  <label for="allscore">你当前的总积分：</label>
	  <span id="allscore"><?php echo $rs['score'];?></span>
	</div>

	<script type="text/javascript" src="jquery.min.js"></script>
  </body>
</html>

<script type="text/javascript">
    $(document).ready(function(){
		$(":submit").click(function(){
			$(this).attr("disabled","disabled"); 
			var score = $("#score").val();
			var token = $("#token").val();
			var current_score = $("#allscore").html()
			//alert(score);
			$.ajax({
               type:"POST",
               url:"./submit.php",
               data:{ 'score' : score,'token' : token },
               success:function(data){
				   alert(data);
				   var allscore = parseInt(current_score)+parseInt(score);
				   
				   if (data=="提交成功！")
				   {
						$("#allscore").html(allscore);
				   }
				   else{
						$("#allscore").html(current_score);
				   }
               },
			   error:function(){
				   alert("提交失败，稍后重试！");
			   }
			});
		});
	});
</script>