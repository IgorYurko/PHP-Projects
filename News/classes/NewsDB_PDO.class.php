<?php
header('Content-type: text/html; charset=utf-8');
error_reporting(E_ALL);
function __autoload($class){
	require $class.'.class.php';
}
class NewsDB_PDO implements INewsDB, IteratorAggregate{//Класс для работы с БД
    				use ClearData, /*ErrorReporting,*/ Querys/*, CreateXML*/;//За надобностью - раскоментировать 
    private $_db;
    private $_category = array();
    const DB_NAME = 'db/news.db';
    const ERROR_FILE_NAME = 'error/error_log.txt';
    const RSS_NAME = 'XML/rss.xml';
    const JS_NAME = 'js/WorkScripts.js';
    const RSS_TITLE = 'Последнии новости';
    
    function __construct(){
        try{
            if(!file_exists(self::DB_NAME) or filesize(self::DB_NAME) === 0){
                $this->_db = new PDO('sqlite:'.$_SERVER['DOCUMENT_ROOT'].'/'.self::DB_NAME);
                $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo_1 = "CREATE TABLE if NOT EXISTS `msgs`(
                                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                                    title TEXT,
                                    category INTEGER,
                                    description TEXT,
                                    source TEXT,
                                    datetime INTEGER)";
                $pdo_2 = "CREATE TABLE if NOT EXISTS `category`(
                                    id integer,
                                    name TEXT)";
                $pdo_3 = "INSERT INTO `category`(id, name)
                                    SELECT 1 as id, 'Политика' as name
                                    UNION SELECT 2 as id, 'Культура' as name
                                    UNION SELECT 3 as id, 'Спорт' as name";
               $this->_db->beginTransaction();
               $this->_db->exec($pdo_1);
               $this->_db->exec($pdo_2);
               $this->_db->exec($pdo_3);
               $this->_db->commit();
            }else{
                $this->_db = new PDO('sqlite:'.$_SERVER['DOCUMENT_ROOT'].'/'.self::DB_NAME);
                $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
         }catch(PDOException $e){
                $this->_db->rollBack();
                $this->_db = null;
                $this->setError($e);
                exit('Произошла ошибка при создании БД: '.$e->getMessage().', в файле: '.$e->getFile().', на строке: '.$e->getLine()); 
         }
    }
    
    function __destruct(){
        unset($this->_db);
    }
    
    function __get($name){
        switch ($name) {
           case '_db' : return $this->_db;
           		break;
           default: return false;
        }
    }
    
    function __call($name, $argument){
		switch($name){
			case 'setError': return false;
				break;
			case 'createRss': return false;
				break;
		}
	}
    
    function getIterator(){
        $this->getCategory();
        $res = new ArrayIterator($this->_category);
        $res->rewind();
        return $res;
    }
}
?>