<?php require_once './protected/database/mariadb.php'?>

<h1 style="text-align:center;">Page Front End</h1>

<div style="display:flex;justify-content:center;width: 100%; flex-wrap: wrap;">

    <?php
        $req = $db->query('SELECT * FROM articles WHERE state = 1 ');
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

            <button onclick="location.href='article.php?id=<?= $article['id'] ?>'">Voir l'article</button>
        </div>

    <?php endforeach ?>
</div>

<div style="display:inline-flex; justify-content: center; align-items: center; width: 100%;">
<?php
    $req = $db->query('SELECT * FROM partners ORDER BY id DESC');
    $allpartners = $req->fetchAll();
    foreach ($allpartners as $partner):
?>
    <div class="partners-containerImage">
        <a href="<?php echo htmlspecialchars($partner['link'], ENT_QUOTES, 'UTF-8') ?>"><img class="partners-Image" src="./protected/elements/media/partners/<?php echo htmlspecialchars($partner['name'], ENT_QUOTES, 'UTF-8') ?>" alt="<?php echo htmlspecialchars($partner['alt'], ENT_QUOTES, 'UTF-8') ?>" id="image-<?php echo htmlspecialchars($partner['id'], ENT_QUOTES, 'UTF-8') ?>"/></a>
    </div>

<?php endforeach ?>
</div>

<style>

.partners-containerImage{
    width: 180px;
    height: 180px;
    border: solid black 1px;
    margin: 5px;
    background-color: #d4d4d4;
    cursor: pointer;
}

.partners-Image{
    height: 100%;
    width: 100%;
    object-fit: contain;
    font-size: 16px;
}

</style>