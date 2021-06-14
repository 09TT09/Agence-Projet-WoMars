<?php require_once '../../../database/mariadb.php'?>
<?php
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $req = $db->query('SELECT * FROM partners WHERE id ='.$id);
        $image = $req->fetchObject();
        $getSize = intval($image->size);
        $sizeToKo = substr(number_format($getSize), 0, -1);
        $dateTime = explode(" ", $image->date);
        if (file_exists('../../media/partners/'.$image->name)){
            list($width, $height) = getimagesize('../../media/partners/'.$image->name);
        }
        $imagePath = str_replace('/pages/back-office.php', '/media/partners/'.htmlspecialchars($image->name, ENT_QUOTES, 'UTF-8'), parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH));
        $imageFullePath = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_SCHEME) . '://' . parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) . $imagePath;
    }
?>

<div class="parameters-contentLeft" id="parameters-contentLeft">
    <div class="parameters-imageContainer">
        <img class="allmedia-get-Image" src="../media/partners/<?php echo htmlspecialchars($image->name, ENT_QUOTES, 'UTF-8') ?>" alt="<?php echo htmlspecialchars($image->alt, ENT_QUOTES, 'UTF-8') ?>"/>
        <figcaption class="parameter-imageFigcaption"><?php echo htmlspecialchars($image->caption, ENT_QUOTES, 'UTF-8') ?></figcaption>
    </div>
</div><!--
--><div class="parameters-contentRight">

    <?php if (file_exists('../../media/partners/'.$image->name)): ?>

    <form action="../traitement/update/updateFilePartners.php?id=<?php echo htmlspecialchars($image->id, ENT_QUOTES, 'UTF-8') ?>" method="POST" id="form-update">

        <label for="name" class="media-label">Title</label><br>
        <input type="text" name="name" value="<?php echo htmlspecialchars($image->name, ENT_QUOTES, 'UTF-8') ?>" class="media-inputtext" /><br><br><br>

        <label for="caption" class="media-label">Caption</label><br>
        <input type="text" name="caption" value="<?php echo htmlspecialchars($image->caption, ENT_QUOTES, 'UTF-8') ?>" class="media-inputtext" /><br><br><br>

        <label for="alt" class="media-label">Alternative text</label><br>
        <input type="text" name="alt" value="<?php echo htmlspecialchars($image->alt, ENT_QUOTES, 'UTF-8') ?>" class="media-inputtext" /><br><br><br>

        <label for="url" class="media-label">URL</label><br>
        <input type="text" name="url" value="<?php echo htmlspecialchars($imageFullePath, ENT_QUOTES, 'UTF-8') ?>" class="media-inputtext" /><br><br><br>

    </form>

    <h3>Image Data</h3>
    <p>File name : <?php echo htmlspecialchars($image->name, ENT_QUOTES, 'UTF-8') ?></p>
    <p>File size : <?php echo htmlspecialchars($sizeToKo, ENT_QUOTES, 'UTF-8') ?> Ko</p>
    <p>File type : <?php echo htmlspecialchars($image->type, ENT_QUOTES, 'UTF-8') ?></p>
    <p>Upload date : <?php echo htmlspecialchars($dateTime[0], ENT_QUOTES, 'UTF-8') ?></p>
    <p>Dimensions : <?php echo htmlspecialchars($width, ENT_QUOTES, 'UTF-8').' x '.htmlspecialchars($height, ENT_QUOTES, 'UTF-8') ?></p>

    <?php else: ?>
        <span style="color: crimson;"><br>This image was not found in the "media" folder.<br><br> Please, delete the path with the image parameters window</span>
    <?php endif; ?>
</div>

<div class="parameters-actions">
    <div class="parameters-actions-left">
        <button class="parameters-button-delete" onclick="location.href='../traitement/delete/deleteFilePartners.php?id=<?php echo htmlspecialchars($image->id, ENT_QUOTES, 'UTF-8') ?>&name=<?php echo htmlspecialchars($image->name, ENT_QUOTES, 'UTF-8') ?>'">Delete</button>
        <input type ="submit" form="form-update" value="Update" name="update" class="parameters-button-update" />
    </div>
</div>