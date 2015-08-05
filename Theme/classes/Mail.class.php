<?php
class Mail{
	private $_to = "vasia@mail.ua";
	private $_obj = "test";
	private $_message = "";
	private static $_instance = null;

	private function __construct(array $arr){
		$this->_message = "Hello, my login: {$arr[0]},\n
							 my phone: {$arr[1]}";
		mail($_to, $_obj, $this->_message);
	}
	
	private function __clone(){}
	
	public function __get($name){
		switch($name){
			case '_to' : return $this->_to;
				break;
			case '_obj': return $this->_obj;
				break;
			case '_message': return $this->_message;
				break;
			
			default:
				return false;
		}
	}
	public function __set($name, $val){
		switch($name){
			case '_to': $this->_to = $val;
				break;
			case '_obj': $this->_obj = $val;
				break;
			case '_message': $this->_message = $val;
			
			default:
				return false;
		}
	}
	public static function getInstance(array $arr){
		if(self::$_instance instanceof self )
					return self::$_instance;
		else return self::$_instance = new Mail($arr);
	}
}
?>