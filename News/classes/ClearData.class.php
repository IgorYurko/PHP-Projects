<?php
trait ClearData{//Чистим данные
	
	public function clearStr($data){
        return trim(strip_tags($data));
    }
    
    public function clearInt($data){
        return abs((int)$data);
    }
}
?>