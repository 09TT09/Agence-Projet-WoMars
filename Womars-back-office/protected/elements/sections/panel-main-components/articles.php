<div class="Page-tools">
    <div class="Page-tools-section">
        <input class="Page-tools-researchbar" id="researchBar" type="text" />
        <button class="Page-tools-researchbutton" id="research">Research</button>
    </div><!--
    --><div class="Page-tools-section">
        <button class="Page-tools-createcontent" onclick="location.href='create-article.php'">Create content</button>
    </div>
</div>

<table class="Page-allcontenttable">

    <thead class="Table-head">
        <tr>
            <th class="Table-id">ID</th>
            <th class="Table-title">Title</th>
            <th class="Table-author">Author</th>
            <th class="Table-date">Date</th>
            <th class="Table-edit">Edit</th>
        </tr>
    </thead>

    <tbody>

        <?php
            $req = $db->query('SELECT * FROM articles ORDER BY id DESC'); 
            $allarticles = $req->fetchAll();
            foreach ($allarticles as $article):
        ?>
            <tr class="line">
                <th class="Table-cell"><?php echo htmlspecialchars($article['id'], ENT_QUOTES, 'UTF-8') ?></th>
                <th class="Table-cell title-search"><?php echo htmlspecialchars($article['title'], ENT_QUOTES, 'UTF-8') ?></th>
                <th class="Table-cell"><?php echo htmlspecialchars($article['author'], ENT_QUOTES, 'UTF-8') ?></th>
                <th class="Table-cell"><?php echo htmlspecialchars($article['date'], ENT_QUOTES, 'UTF-8') ?></th>
                <th class="Table-cell-edit" onclick="location.href='edit-article.php?id=<?php echo htmlspecialchars($article['id'], ENT_QUOTES, 'UTF-8') ?>'">Edit</th>
            </tr>
        <?php endforeach ?>

    </tbody>
</table>
