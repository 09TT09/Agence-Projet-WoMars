<?php require_once '../../database/mariadb.php'?>
<?php
if(isset($_POST['id'])){
  $id = $_POST['id'];
  $req = $db->query('SELECT * FROM images WHERE id ='.$id);
  $image = $req->fetchObject();
}

$getSize = intval($image->size);
$sizeToKo = number_format($getSize);
?>

<div class="parameters-contentLeft" id="parameters-contentLeft">
    <img class="media-get-Image" src="../media/<?= $image->name ?>" />
</div><!--
--><div class="parameters-contentRight">

    <label for="imagetitle">Title</label><br>
    <input type="text" name="imagetitle" value="<?= $image->name ?>"><br><br><br>

    <label for="imagecaption">Caption</label><br>
    <input type="text" name="imagecaption" value=""><br><br><br>

    <label for="imagealt">Alternative text</label><br>
    <input type="text" name="imagealt" value=""><br><br><br>

    <label for="imagedescription">Description</label><br>
    <input type="text" name="imagedescription" value=""><br><br><br>

    <label for="imageurl">URL</label><br>
    <input type="text" name="imageurl" value="../media/<?= $image->name ?>"><br><br><br>

    <h3>Image Data</h3>
    <p>File name : <?= $image->name ?></p>
    <p>File size : <?= $sizeToKo ?> Ko</p>
    <p>File type : <?= $image->type ?></p>
</div>
<div class="parameters-actions">
    <div class="parameters-actions-left">
        <button class="parameters-button-delete">Supprimer</button>
    </div>
</div>