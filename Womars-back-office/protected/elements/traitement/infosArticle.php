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