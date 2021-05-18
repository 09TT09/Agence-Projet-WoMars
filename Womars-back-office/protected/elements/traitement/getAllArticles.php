<?php
    $req = $db->query('SELECT * FROM articles ORDER BY id DESC'); 
    $allarticles = $req->fetchAll();
    foreach ($allarticles as $article):
?>
    <tr class="line">
        <th class="Table-cell"><?= $article['Id']?></th>
        <th class="Table-cell title-search"><?= $article['title']?></th>
        <th class="Table-cell"><?= $article['author']?></th>
        <th class="Table-cell"><?= $article['date']?></th>
        <th class="Table-cell-edit" onclick="location.href='edit-article.php?id=<?= $article['Id'] ?>'">Edit</th>
    </tr>
<?php endforeach ?>