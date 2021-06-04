<?php require_once '../../../database/mariadb.php'?>
<?php
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $req = $db->query('SELECT * FROM crew WHERE id ='.$id);
        $image = $req->fetchObject();
        $getSize = intval($image->size);
        $sizeToKo = substr(number_format($getSize), 0, -1);
        $dateTime = explode(" ", $image->date);
        if (file_exists('../../media/crew/'.$image->name)){
            list($width, $height) = getimagesize('../../media/crew/'.$image->name);
        }
        $imagePath = str_replace('/pages/back-office.php', '/media/crew/'.htmlspecialchars($image->name, ENT_QUOTES, 'UTF-8'), parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH));
        $imageFullePath = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_SCHEME) . '://' . parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) . $imagePath;
    }
?>
<div class="parameters-header">
    <div class="parameters-header-right">
        <button class="parameters-buttonform parameters-buttonform-onit" id="parameters-buttonform-image">Image</button><!--
        --><button class="parameters-buttonform" id="parameters-buttonform-page">Biography</button>
    </div>
</div>

<div class="parameters-contentLeft" id="parameters-contentLeft">
    <div style="max-width: 98%; max-height: 98%;">
        <img class="allmedia-get-Image" src="../media/crew/<?php echo htmlspecialchars($image->name, ENT_QUOTES, 'UTF-8') ?>" alt="<?php echo htmlspecialchars($image->alt, ENT_QUOTES, 'UTF-8') ?>"/>
        <figcaption style="background-color: black; color: white; diplay: block;"><?php echo htmlspecialchars($image->caption, ENT_QUOTES, 'UTF-8') ?></figcaption>
    </div>
</div><!--
--><div class="parameters-contentRight" id="parameters-contentRight">

    <?php if (file_exists('../../media/crew/'.$image->name)): ?>

    <form action="../traitement/update/updateFileCrew.php?id=<?php echo htmlspecialchars($image->id, ENT_QUOTES, 'UTF-8') ?>" method="POST" id="form-update">

        <span id="imagePageChange">
            <label for="name" class="media-label">Title</label><br>
            <input type="text" name="name" value="<?php echo htmlspecialchars($image->name, ENT_QUOTES, 'UTF-8') ?>" class="media-inputtext" /><br><br><br>

            <label for="caption" class="media-label">Caption</label><br>
            <input type="text" name="caption" value="<?php echo htmlspecialchars($image->caption, ENT_QUOTES, 'UTF-8') ?>" class="media-inputtext" /><br><br><br>

            <label for="alt" class="media-label">Alternative text</label><br>
            <input type="text" name="alt" value="<?php echo htmlspecialchars($image->alt, ENT_QUOTES, 'UTF-8') ?>" class="media-inputtext" /><br><br><br>

            <label for="url" class="media-label">URL</label><br>
            <input type="text" name="url" value="<?php echo htmlspecialchars($imageFullePath, ENT_QUOTES, 'UTF-8') ?>" class="media-inputtext" /><br><br><br>
        </span>

        <span style="display:none;" id="imagePageChangePerson">
            <label for="personname" class="media-label">Name</label><br>
            <input type="text" name="personname" value="<?php echo htmlspecialchars($image->personname, ENT_QUOTES, 'UTF-8') ?>" class="media-inputtext" /><br><br><br>

            <label for="profession" class="media-label">Profession</label><br>
            <input type="text" name="profession" value="<?php echo htmlspecialchars($image->profession, ENT_QUOTES, 'UTF-8') ?>" class="media-inputtext" /><br><br><br>

            <label for="biography" class="media-label">Biography</label><br>
            <textarea name="biography" class="media-inputtextarea"><?php echo htmlspecialchars($image->biography, ENT_QUOTES, 'UTF-8') ?></textarea>
        </span>

    </form>

    <span id="imagePageChangeData">
        <h3>Image Data</h3>
        <p>File name : <?php echo htmlspecialchars($image->name, ENT_QUOTES, 'UTF-8') ?></p>
        <p>File size : <?php echo htmlspecialchars($sizeToKo, ENT_QUOTES, 'UTF-8') ?> Ko</p>
        <p>File type : <?php echo htmlspecialchars($image->type, ENT_QUOTES, 'UTF-8') ?></p>
        <p>Upload date : <?php echo htmlspecialchars($dateTime[0], ENT_QUOTES, 'UTF-8') ?></p>
        <p>Dimensions : <?php echo htmlspecialchars($width, ENT_QUOTES, 'UTF-8').' x '.htmlspecialchars($height, ENT_QUOTES, 'UTF-8') ?></p>
    </span>

    <?php else: ?>
        <span style="color: crimson;"><br>This image was not found in the "media" folder.<br><br> Please, delete the path with the image parameters window</span>
    <?php endif; ?>
</div>

<div class="parameters-actions">
    <div class="parameters-actions-left">
        <button class="parameters-button-delete" onclick="location.href='../traitement/delete/deleteFileCrew.php?id=<?php echo htmlspecialchars($image->id, ENT_QUOTES, 'UTF-8') ?>&name=<?php echo htmlspecialchars($image->name, ENT_QUOTES, 'UTF-8') ?>'">Delete</button>
        <input type ="submit" form="form-update" value="Update" name="update" class="parameters-button-update" />
    </div>
</div>

<style>
    .parameters-exit{
        display: inline-block !important;
        vertical-align: top;
    }

    .parameters-header{
        display: inline-block;
        width: calc(100% - 46px);
    }

    .parameters-header-right{
        text-align: right;
        float: right;
    }

    .parameters-buttonform{
        display: inline-block !important;
        margin: 0 0 0 10px;
        width: 200px;
        height: 35px;
        font-size: 16px;
        background-color: #0A0623;
        border: 0;
        color: white;
        cursor: pointer;
        transition: .25s;
        margin-left: 10px;
        border: solid white 1px;
        border-top: 0;
    }
    .parameters-buttonform:hover{
        background-color: #d37029;
    }

    .parameters-buttonform:last-child{
        margin: 0 10px 0 0;
    }

    .parameters-buttonform-onit{
        background-color: #F37C26;
        color: #0A0623;
    }

    .parameters-contentRight-page{
        display: inline-block;
        width: calc(100% - 20px);
        height: 80%;
        margin: 10px 10px 0 10px;
        border: solid black 1px;
        background-color: #d4d4d4;
        vertical-align: top;
        text-align: center;
        overflow: auto;
    }
</style>