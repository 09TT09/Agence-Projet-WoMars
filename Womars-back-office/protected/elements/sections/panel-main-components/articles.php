<div class="Page-tools">
    <div class="Page-tools-section">
        <div class="page-input-container">          
            <svg class="page-input-icone-search" version="1.1" id="Calque_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 300 300" enable-background="new 0 0 300 300" xml:space="preserve">
                <path d="M275.9,259.5L178.4,162c-0.2-0.2-0.5-0.5-0.8-0.7c12.4-15.1,19.8-34.5,19.8-55.6c0-48.5-39.3-87.9-87.9-87.9c-48.5,0-87.9,39.3-87.9,87.9c0,48.5,39.3,87.9,87.9,87.9c21.1,0,40.5-7.4,55.6-19.8c0.2,0.3,0.4,0.5,0.7,0.8l97.5,97.5c3.5,3.5,9.1,3.5,12.5,0C279.3,268.6,279.3,263,275.9,259.5z M109.6,178.3c-40.1,0-72.5-32.5-72.5-72.5c0-40.1,32.5-72.5,72.5-72.5c40.1,0,72.5,32.5,72.5,72.5C182.1,145.8,149.6,178.3,109.6,178.3z"/>
            </svg>
            <input type="text" class="Page-tools-researchbar" placeholder="Search an article" id="researchBar"/>
        </div>
    </div><!--
    --><div class="Page-tools-section">
        <button class="Page-tools-createcontent" onclick="location.href='create-article.php'">Create article</button>
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
                <th class="Table-cell <?php
                    if($article['state'] === '0'){echo htmlspecialchars('Table-cell-red', ENT_QUOTES, 'UTF-8');}
                    else {echo htmlspecialchars('Table-cell-green', ENT_QUOTES, 'UTF-8');} 
                ?>"><?php echo htmlspecialchars($article['id'], ENT_QUOTES, 'UTF-8') ?></th>
                <th class="Table-cell title-search"><?php echo htmlspecialchars($article['title'], ENT_QUOTES, 'UTF-8') ?></th>
                <th class="Table-cell Table-cell-author"><?php echo htmlspecialchars($article['author'], ENT_QUOTES, 'UTF-8') ?></th>
                <th class="Table-cell Table-cell-date"><?php echo htmlspecialchars($article['date'], ENT_QUOTES, 'UTF-8') ?></th>
                <th class="Table-cell-edit" onclick="location.href='edit-article.php?id=<?php echo htmlspecialchars($article['id'], ENT_QUOTES, 'UTF-8') ?>'">Edit</th>
            </tr>
        <?php endforeach ?>

    </tbody>
</table>
