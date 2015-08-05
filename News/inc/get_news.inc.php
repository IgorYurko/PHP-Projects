<?php
if(!is_array($res = $news->getNews())) 
    $errMsg = 'Произошла ошибка при выводе новосной ленты';
else{
    $count = count($res);
    echo <<<COUNT
        <hr/>
        <h2 style="text-align: center; color: red;">На данный момент у вас $count новых новостей</h2>
        <hr/>
COUNT;
    foreach ($res as $val) {
        $time = date('l jS \of F Y H:i:s', $val['datetime']);
        $desc = nl2br($val['description']);
        preg_match('|[a-z]{1}[a-z0-9_\-\.\@]{1,}\.[a-zа-я]{1,12}|iu', $val['source'], $matches);
        echo <<<NEWS
            <section>
                <h3>{$val['category']} || <a href="{$val['source']}">{$val['title']}
                    <a href='{$_SERVER["PHP_SELF"]}?del={$val['id']}' style="float: right; font: bold 15px Georgia;">
                        Удалить новость
                    </a>
                </h3>
                <article>
                    <blockquote>$desc</blockquote>
                </article>
                <div>
                    <address style= "display: inline;">{$matches[0]}</address>
                    <time style= "display: inline; float: right;">$time</time>
                </div>
                <hr/>
            </section>
NEWS;
    }
}
?>