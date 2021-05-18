<?php require_once '../traitement/infosArticle.php'?>
<div style="text-align:center;width:60%; margin: auto;">
    <h2><?= $article->title ?></h2>
    <p><?= $article->description ?></p>
    <p><?= $article->text ?></p>
    <p>Réalisé(e) par <?= $article->author ?><br><br>
    Le <?= $dateTime[0] .' à '. $dateTime[1] ?></p>

    <br><br><br><br><br><br>

    <form action="../traitement/updateArticle.php?id=<?= $article->Id ?>" method="POST" style="text-align:center;">
        <p class="article-title">Titre</p>
        <p><input type="text" name="title" class="article-input"></p>
        <p class="article-title">Auteur</p>
        <p><input type="text" name="author" class="article-input"></p>
        <p class="article-title">Description</p>
        <p><textarea name="description" class="article-textarea"></textarea></p>
        <p class="article-title">texte</p>
        <p><textarea name="text" class="article-textarea"></textarea></p>
        <input type ="submit" value="Modifier" name="update" class="article-button article-button-params">  
    </form>

    <button onclick="location.href='../traitement/deleteArticle.php?id=<?= $article->Id ?>'" class="article-button-delete">Supprimer</button>
</div>