<?php require_once '../../../database/mariadb.php'?>
<?php
    if(isset($_POST['imagepage']) && isset($_POST['wherepage'])){
        if ($_POST['wherepage'] === "next"){
            $currentPage = $_POST['imagepage'] + 1;
        }
        else{
            $currentPage = $_POST['imagepage'] - 1;
        }
    }

    $counter = (int)$db->query('SELECT COUNT(id) FROM images')->fetch(PDO::FETCH_NUM)[0];
    $imagePerPage = 30;
    $pages = ceil($counter / $imagePerPage);
    $offset = $imagePerPage * ($currentPage - 1);

    $req = $db->query("SELECT * FROM images ORDER BY id DESC LIMIT $imagePerPage OFFSET $offset"); 
    $allimages = $req->fetchAll();
    foreach ($allimages as $image):
?>

    <?php if (file_exists('../../media/media/'.$image['name'])): ?>
        <div class="createarticle-containerImage" onclick="selectedImage(this)" id="containerImage-<?php echo htmlspecialchars($image['id'], ENT_QUOTES, 'UTF-8') ?>">
            <img class="createarticle-Image" src="../media/media/<?php echo htmlspecialchars($image['name'], ENT_QUOTES, 'UTF-8') ?>"  alt="<?php echo htmlspecialchars($image['alt'], ENT_QUOTES, 'UTF-8') ?>" id="image-<?php echo htmlspecialchars($image['id'], ENT_QUOTES, 'UTF-8') ?>"/>
        </div>
    <?php endif; ?>
    
<?php endforeach ?>

<div style="width: 100%; text-align: center; margin: 20px 0;">
    <?php if($currentPage > 1): ?>
        <button class="button-paging" id="previous" onclick="getPage(this)">Page précédente</button>
    <?php endif ?>
    <?php if($currentPage < $pages): ?>
        <button class="button-paging" id="next" onclick="getPage(this)">Page suivante</button>
    <?php endif ?>
</div>

<div id="getCurrentPage" style="display: none;"><?php echo $currentPage ?></div>
