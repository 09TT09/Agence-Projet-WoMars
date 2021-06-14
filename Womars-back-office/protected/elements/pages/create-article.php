<?php require_once '../../database/mariadb.php'?>
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
        <div class="wysiwyg-getImage" id="wysiwyg-getImage">
            <div class="wysiwyg-getImageDiv">  
                <button class="parameters-exit" id="exit">X</button><span>Select an image</span>
                <div class="createarticle-allImageContainer">
                    <?php
                        $req = $db->query('SELECT * FROM images ORDER BY id DESC'); 
                        $allimages = $req->fetchAll();
                        foreach ($allimages as $image):
                    ?>
                        <?php if (file_exists('../media/'.$image['name'])): ?>
                            <div class="createarticle-containerImage" onclick="selectedImage(this)" id="containerImage-<?php echo htmlspecialchars($image['id'], ENT_QUOTES, 'UTF-8') ?>">
                                <img class="createarticle-Image" src="../media/<?php echo htmlspecialchars($image['name'], ENT_QUOTES, 'UTF-8') ?>"  alt="<?php echo htmlspecialchars($image['alt'], ENT_QUOTES, 'UTF-8') ?>" id="image-<?php echo htmlspecialchars($image['id'], ENT_QUOTES, 'UTF-8') ?>"/>
                            </div>
                        <?php endif; ?>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
        <?php include("../sections/section-navbar.php"); ?>
        <?php include("../sections/section-article-create.php"); ?>
    </body>
</html>