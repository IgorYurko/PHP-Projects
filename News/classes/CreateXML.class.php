<?php
trait CreateXML{//Класс для работы с XML
	
	public function createRss(){//Создание xml документа с помощю <<<SimpleXml>>>
        if(file_exists(self::RSS_NAME)) unlink(self::RSS_NAME);
            $sxml = new SimpleXMLElement("<?xml version='1.0' encoding='utf-8' ?>\n<rss>\n</rss>");
            $sxml->addAttribute('version', '2.0');
            $chanel = $sxml->addChild('chanel');
            $chanel->addChild('title', self::RSS_TITLE);
            $chanel->addChild('link', "http://{$_SERVER['SERVER_NAME']}{$_SERVER['PHP_SELF']}");
            $res = $this->getNews();
            
            foreach ($res as $val) {
                $item = $chanel->addChild('item');
                $item->addChild('title', $val['title']);
                $item->addChild('link', $val['source']);
                $item->addChild('description', $val['description']);
                $item->addChild('pubDate', date('r', $val['datetime']));
                $item->addChild('category', $val['category']);
            }
            file_put_contents(self::RSS_NAME, $sxml->asXML(), LOCK_EX | FILE_APPEND);
    }
}
?>