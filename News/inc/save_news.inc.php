<?php
$title = $news->clearStr($_POST['title']);
$category = $news->clearInt($_POST['category']);
$description = $news->clearStr($_POST['description']);
$source = $news->clearStr($_POST['source']);

if(empty($title) or empty($description) or empty($source)) {
    $_SESSION["errMsg"] = 'Заполните все поля';
    header('Location: http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']);
}    
else {
    if($news->saveNews($title, $category, $description, $source) === 1){
    	$_SESSION["errMsg"] = null;
		header('Location: http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']);	
	}
    else $_SESSION["errMsg"] = 'Произошла ошибка при добавлении новости, попробуйте позже.';  
}

?>