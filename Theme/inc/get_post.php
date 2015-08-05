<?php
	function __autoload($name){
		require_once "classes/$name.class.php";
	}
if($_SERVER['REQUEST_METHOD'] == "POST"){
		$obj_1 = Valid::getInstance();
	if( !$res = $obj_1->type( array ( $_POST['login'], $_POST['pass']) ) ) $error = "Введены некоректные значения!";
	//Принцып сортировки в том, чтоб сразу кидать все данные формы в метод, можно передавать и другие параметры, например строку или число, которое, для увериности можно привести к (int);
	else {
		//list($login, $phone) = $res;//Разбивка на переменные
		$obj_2 = Mail::getInstance($res);
		header("Location:".$_SERVER['PHP_SELF']);
	}
}
?>