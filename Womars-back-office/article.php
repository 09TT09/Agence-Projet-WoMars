<?php require_once './protected/database/mariadb.php'?>

<?php

function getArticles($db, $nb = null, $id = null){
	if ($nb AND !$id) {
		$req = $db->query('SELECT * FROM articles LIMIT'.$nb);
	    $articles = $req->fetchAll();
	}
    elseif($id){
	    $req = $db->query('SELECT * FROM articles WHERE id ='.$id);
		$articles = $req->fetchObject();	
	}
	else{
	    $req = $db->query('SELECT * FROM articles');
		$articles = $req->fetchAll();
    }
	return $articles;
}

$article = getArticles($db,1, $_GET['id']);
$dateTime = explode(" ", $article->date);

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>WoMars Agence</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0" />
        <meta name="description" content="Site WoMars" />
        <meta name="robots" content="noindex" />
        <link rel="stylesheet" type="text/css" href="../style/backoffice-style.css" />
    </head>

    <body>
        <div style="text-align:center;width:60%; margin: auto;">
            <h2><?= $article->title ?></h2>
            <p>Réalisé(e) par <?= $article->author ?><br><br>
            Le <?= $dateTime[0] .' à '. $dateTime[1] ?></p><br>
            <!--<p><//?= $article->description ?></p><br><br>-->
            <p><?= $article->text ?></p>
        </div>
    </body>
</html>
