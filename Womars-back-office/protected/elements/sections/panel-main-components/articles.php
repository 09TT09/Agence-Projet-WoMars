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
        <?php require_once '../traitement/getAllArticles.php'?>
    </tbody>
</table>
