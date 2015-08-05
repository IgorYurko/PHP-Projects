<?php
if(!$id = $news->clearInt($_GET['del'])) $errMsg = 'Хакер не ламай мою новосную ленту';
else {
    if(!$news->deleteNews($id)) $errMsg = 'Произошла ошибка при удалении новости';
    else header('Location:'.$_SERVER["HTTP_REFERER"]);
    }
?>