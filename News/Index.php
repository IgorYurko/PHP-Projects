<?php
header('Content-type:text/html; charset=utf-8');
session_start();
require_once 'classes/NewsDB_PDO.class.php';
$news = new NewsDB_PDO();
if($_SERVER["REQUEST_METHOD"] == 'POST') include_once 'inc/save_news.inc.php';
if(isset($_GET['del'])) include_once 'inc/delete_news.inc.php'; 
?>
<!DOCTYPE html>

<html>
<head>
	<title>Новостная лента</title>
	<meta charset="utf-8"/>
	<script type="text/javascript" src="http://yastatic.net/jquery/2.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="http://yastatic.net/jquery-ui/1.11.1/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?= $news::JS_NAME;?>"></script>
	<link type="text/css" rel="stylesheet" href="css/Style.css"/>
</head>

<body>
<div class="main">
<header>Последние новости</header>
<?php
if(!empty($_SESSION["errMsg"])) echo "<div style='font:bold italic 18px Georgia; color: red;'>".$_SESSION["errMsg"]."</div>";
?>
<form action="<?=$_SERVER['PHP_SELF'];?>" method="post">

	<label for="title">Заголовок новости:</label><br />
	<input id="title" type="text" name="title" /><br />
	
	<label for="category">Выберите категорию:</label><br />
	<select id="category" name="category">
		<? foreach ($news as $key => $val) : ?> 
		<?= "<option value='{$key}'>{$val}</option>\n";?>   
		<?endforeach;?>
	</select><br />
	
	<label for="desc">Текст новости:</label><br />
	<textarea id="desc" name="description" cols="50" rows="5"></textarea><br />
	
	<label for="source">Источник:</label><br />
	<input id="source" type="text" name="source" /><br />
	<br />
	<button type="submit" name="sub" value="go">Отправить</button>

</form>

<?php
include_once 'inc/get_news.inc.php';
?>
</div>
</body>
</html>