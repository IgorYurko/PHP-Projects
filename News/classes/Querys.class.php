<?php
trait Querys{//Запросы
	
	private function getCategory(){//Выборка категорий
        try{
            $pdo = "SELECT id, name FROM `category`";
            $con = $this->_db->query($pdo);
            while($res = $con->fetch(PDO::FETCH_ASSOC)){
                $this->_category[$res['id']] = $res['name'];
            }
            $con = null;
        }catch(PDOException $e){
        	$con = null;
        	$this->setError($e);
            exit('Ошибка при виборке: '.$e->getMessage().', в файле: '.$e->getFile().', на строке: '.$e->getLine());
        }
    }
    
    public function saveNews($title, $category, $discription, $source){//Запись в БД новой статьи
        $dt = time();
        try{
            $pdo = "INSERT INTO `msgs`(title, category, description, source, datetime)
                            VALUES (?, ?, ?, ?, ?)";
            
            $stmt = $this->_db->prepare($pdo);
            $stmt->bindParam(1, $title, PDO::PARAM_STR);
            $stmt->bindParam(2, $category, PDO::PARAM_INT);
            $stmt->bindParam(3, $discription, PDO::PARAM_STR);
            $stmt->bindParam(4, $source, PDO::PARAM_STR);
            $stmt->bindParam(5, $dt, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->rowCount();
            $stmt = null;
            $this->createRss();
            return $row;//Возвращаем количество затронутых рядов запроса.
        }catch(PDOException $e){
            $stmt = null;
            $this->setError();
            exit('Ошибка при добавлении: '.$e->getMessage().', в файле: '.$e->getFile().', на строке: '.$e->getLine()); 
        }
    }
    
    public function getNews(){//Выборка всех статей
        $pdo = "SELECT m.id, c.name as category, m.title, m.description, m.source, m.datetime
                    FROM msgs m JOIN category c 
                        ON m.category = c.id ORDER BY m.datetime DESC LIMIT 10";
        try{
            $res = $this->_db->query($pdo);
            $arr = $res->fetchAll(PDO::FETCH_ASSOC);
            $res = null;
            return $arr;
        }catch(PDOException $e){
            $res = null;
            $this->setError($e);
            exit('Ошибка при выборке данных: '.$e->getMessage().', в файле: '.$e->getFile().', на строке: '.$e->getLine());
        }
    }
    
    public function deleteNews($id){//Удаление конкретной саписи из БД
    	$id = $this->_db->quote($id);
        $pdo = "DELETE FROM `msgs` WHERE id = $id";
        try{
            $res = $this->_db->query($pdo);
            $row = $res->rowCount();
            $res = null;
            return $row;     
        }catch(PDOException $e){
            $res = null;
            $this->setError($e);
            exit('Ошибка при удалении данных: '.$e->getMessage().', в файле: '.$e->getFile().', на строке: '.$e->getLine());
        }
    }
}
?>