<?php
    if(isset($_GET['id'])){
        $req = $db->query('SELECT * FROM articles WHERE id ='.$_GET['id']);
        $article = $req->fetchObject();
		$dateTime = explode(" ", $article->date);
    }
?>