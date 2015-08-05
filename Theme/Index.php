<?php
header("Content-Type: text/html; charset= utf-8");
require_once "inc/get_post.php";
?>
<!DOCTYPE HTML>
<html>
<head>

	<title>JQuery</title>
	<meta charset="UTF-8">
	<link type="text/css" rel="stylesheet" href="css/stile.css"/>
	<link type="text/css" rel="stylesheet" href="css/jquery-ui.css"/>
	<script type="text/javascript" src="http://yastatic.net/jquery/2.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="http://yastatic.net/jquery-ui/1.11.1/jquery-ui.min.js"></script>
	<script type="text/javascript" src="js/skripts.js"></script>
	
</head>
<body>
<div class="main">
	<div class="error"><?php echo $error ;?></div>
	<header><h2>Привет</h2></header>

	<img src="img/cont.jpg" width="960"/>
		
		<div id="dialog" title="Введите ваши данные">
					
			 <form action="<?= $_SERVER['SCRIPT_NAME']; ?>" method="POST">
				  
				  <label for="login">Ведите логин:</label>
				  <input type="text" id="login" name="login"/>
				  
				  <label for="pass">Введите пароль:</label>
				  <input type="text" id="pass" name="pass"/>
				  
				  <button id="sub" type="submit" name="sub" value="go">Отправить</button>  
			  </form>

		</div>

	<button id="opener">Заказать услугу</button>
</div>
 
</body>
</html>