<?php

$sql='SELECT nr,title,preface,body,pic_mime,art_num, author, submit_date FROM care_news_article WHERE nr='.$nr;

    if($ergebnis=$db->Execute($sql)) {
        $news=$ergebnis->FetchRow();
    }
?>
