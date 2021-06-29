<form action="../traitement/insert/fileTransfert.php" method="post" enctype="multipart/form-data">
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

<?php
    if(isset($_GET['errorMedia'])){
        $error = $_GET['errorMedia'];
        $errorText;
        if ($error === 'error1'){$errorText = 'No file chosen';}
        if ($error === 'error2'){$errorText = "An error occured when uploading your file.";}
        if ($error === 'error3'){$errorText = "Your file already exists.";}
        if ($error === 'error4'){$errorText = "Your file is too large.";}
        if ($error === 'error5'){$errorText = "Only JPG, JPEG, PNG & GIF files are allowed.";}
        if ($error === 'error6'){$errorText = "Sorry, your file was not uploaded.";}
        if ($error === 'error7'){$errorText = "File is not an image.";}
    }
?>

<?php if (isset($_GET['errorMedia'])): ?>
    <div class="divErrorCases">
        <p>Error : <?php echo htmlspecialchars($errorText, ENT_QUOTES, 'UTF-8') ?></P>
    </div>
<?php endif ?>

<div class="media-galerie" id="galerie">
    <?php
        $req = $db->query('SELECT * FROM images ORDER BY id DESC'); 
        $allimages = $req->fetchAll();
        foreach ($allimages as $image):
    ?>

        <div class="media-containerImage" onclick="editImage(this)" id="containerImage-<?php echo htmlspecialchars($image['id'], ENT_QUOTES, 'UTF-8') ?>">
            <?php if (file_exists('../media/'.$image['name']) === false): ?>
                <div class="error">
                    <p>This image was not found in the "media" folder.<br><br> Please, delete the path with the image parameters window</p>
                </div>
            <?php else: ?>
                <img class="media-Image" src="../media/<?php echo htmlspecialchars($image['name'], ENT_QUOTES, 'UTF-8') ?>"  alt="<?php echo htmlspecialchars($image['alt'], ENT_QUOTES, 'UTF-8') ?>" id="image-<?php echo htmlspecialchars($image['id'], ENT_QUOTES, 'UTF-8') ?>"/>
            <?php endif; ?>
        </div>

    <?php endforeach ?>
</div>

<style>

.media-galerie{
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 100px;
}

.media-containerImage{
    width: 180px;
    height: 180px;
    border: solid black 1px;
    margin: 5px;
    background-color: #d4d4d4;
}

.media-Image{
    height: 100%;
    width: 100%;
    object-fit: contain;
    font-size: 16px;
}

.allmedia-get-Image{
    height: 100%;
    width: 100%;
    object-fit: contain;
}

.error{
    width: 100%;
    height: 100%;
    overflow: auto;
    color: crimson;
    font-size: 14px;
}

.divErrorCases{
    overflow: auto;
    color: crimson;
    font-size: 18px;
}

</style>