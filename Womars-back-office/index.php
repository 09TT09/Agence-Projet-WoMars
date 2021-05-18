<?php require_once './protected/database/mariadb.php'?>

<h1 style="text-align:center;">Page Front End</h1>

<div style="display:flex;justify-content:center;width: 100%; flex-wrap: wrap;">

    <?php
        $req = $db->query('SELECT * FROM articles'); 

        $allarticles = $req->fetchAll();
        foreach ($allarticles as $article):

        $dateTime = explode(" ", $article['date']);
    ?>

        <div style="border: solid black 1px; width: 400px; height: 400px; margin: 20px; text-align: center;">
            <h2><?= $article['title']?></h2>
            <p><?= 'réalisé(e) par '.$article['author'] ?></p>
            <p><?= ' le '.$dateTime[0].' à '.$dateTime[1] ?></p>

            <div style="width: 88%;margin: auto; height: 180px; border: solid black 1px;padding: 0 10px;overflow:hidden;">
                <p style="text-align:left; margin: 5 auto;"><?= $article['description'] ?></p>
            </div><br>

            <button onclick="location.href='article.php?id=<?= $article['Id'] ?>'">Voir l'article</button>
        </div>

    <?php endforeach ?>

</div>