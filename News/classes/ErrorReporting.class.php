<?php
trait ErrorReporting{//Лог с колекцией ошибок
	
	private function setError($e){
		file_put_contents(self::ERROR_FILE_NAME, 'Ошибка: '.$e->getMessage().",\n\t".
													'в файле: '.$e->getFile().",\n\t".
													'на строке: '.$e->getLine().",\n\t".
													'время: '.date('Y-m-d H:i:s').".\n\n",
							LOCK_EX | FILE_APPEND);
	}
}
?>