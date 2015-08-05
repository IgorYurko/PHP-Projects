<?php
class Valid {
	private static $_instance;
	private $_arr = array();
	
	private function __construct(){}
	
	private function __clone(){}
		
	public static function getInstance(){
		if(self::$_instance instanceof self)
			return self::$_instance;
		else return self::$_instance = new Valid();
	}
	
	public function type($type){
		switch(gettype($type)){
			case 'string': return $this->clearStr($type);
					break;
			case 'integer': return $this->clearInt($type);
			case 'array' : 
				foreach($type as $val){
					if(is_string($val)){
						if($val = $this->clearStr($val))
							$this->_arr[] = $val;
					}
					if(is_integer($val) and ($this->clearInt($val) > -1))
						$this->_arr[] = $this->clearInt($val);
				}
				if(!array_diff_key($type, $this->_arr) and !empty($this->_arr)) return $this->_arr;
				else return false;
					break;
				
			default: return false;
		}
	}
	
	private function clearStr($str){
		return trim(strip_tags($str));
	}
	
	private function clearInt($int){
		return abs($int);
	}
}

?>