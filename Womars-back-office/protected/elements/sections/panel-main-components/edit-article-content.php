<?php
    if(isset($_GET['id'])){
        $req = $db->query('SELECT * FROM articles WHERE id ='.$_GET['id']);
        $article = $req->fetchObject();
		$dateTime = explode(" ", $article->date);
    }
?>
<div style="text-align:center;width:60%; margin: auto;">
    <h2><?php echo htmlspecialchars($article->title, ENT_QUOTES, 'UTF-8') ?></h2>
    <p><?php echo htmlspecialchars($article->description, ENT_QUOTES, 'UTF-8') ?></p>
    <p><?php echo htmlspecialchars($article->text, ENT_QUOTES, 'UTF-8') ?></p>
    <p>Realized by <?php echo htmlspecialchars($article->author, ENT_QUOTES, 'UTF-8') ?><br><br>
    On <?php echo htmlspecialchars($dateTime[0], ENT_QUOTES, 'UTF-8') .' at '. htmlspecialchars($dateTime[1], ENT_QUOTES, 'UTF-8') ?></p>

    <br><br><br><br><br><br>

    <form action="../traitement/update/updateArticle.php?id=<?php echo htmlspecialchars($article->id, ENT_QUOTES, 'UTF-8') ?>" method="POST" style="text-align:center;">
        <p class="article-title">Title</p>
        <p><input type="text" name="title" value="<?php echo htmlspecialchars($article->title, ENT_QUOTES, 'UTF-8') ?>" class="article-input"></p>
        <p class="article-title">Author</p>
        <p><input type="text" name="author" value="<?php echo htmlspecialchars($article->author, ENT_QUOTES, 'UTF-8') ?>" class="article-input"></p>
        <p class="article-title">Description</p>
        <p><textarea name="description" class="article-textarea"><?php echo htmlspecialchars($article->description, ENT_QUOTES, 'UTF-8') ?></textarea></p>
        <p class="article-title">Text</p>
        <p><div contentEditable="true" name="text" class="article-textarea"><?php echo htmlspecialchars($article->description, ENT_QUOTES, 'UTF-8') ?></div></p>

        <input type="submit" value="Update" name="update" class="article-button article-button-params">  
    </form>

    <button onclick="location.href='../traitement/delete/deleteArticle.php?id=<?php echo htmlspecialchars($article->id, ENT_QUOTES, 'UTF-8') ?>'" class="article-button-delete">Delete</button>
</div>