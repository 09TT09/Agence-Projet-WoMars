<form action="../traitement/insert/imageTransfertPartners.php" method="post" enctype="multipart/form-data">
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

<?php
    if(isset($_GET['errorPartners'])){
        $error = $_GET['errorPartners'];
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

<?php if (isset($_GET['errorPartners'])): ?>
    <div class="divErrorCases">
        <p>Error : <?php echo htmlspecialchars($errorText, ENT_QUOTES, 'UTF-8') ?></P>
    </div>
<?php endif ?>

<div class="partners-galerie" id="galerie">
    <?php
        $req = $db->query('SELECT * FROM partners ORDER BY id DESC'); 
        $allpartners = $req->fetchAll();
        foreach ($allpartners as $partner):
    ?>

        <div class="partners-containerImage" onclick="editImage(this)" id="containerImage-<?php echo htmlspecialchars($partner['id'], ENT_QUOTES, 'UTF-8') ?>">
            <?php if (file_exists('../media/partners/'.$partner['name']) === false): ?>
                <div class="error">
                    <p>This image was not found in the "partners" folder.<br><br> Please, delete the path with the image parameters window</p>
                </div>
            <?php else: ?>
                <img class="partners-Image" src="../media/partners/<?php echo htmlspecialchars($partner['name'], ENT_QUOTES, 'UTF-8') ?>" alt="<?php echo htmlspecialchars($partner['alt'], ENT_QUOTES, 'UTF-8') ?>" id="image-<?php echo htmlspecialchars($partner['id'], ENT_QUOTES, 'UTF-8') ?>"/>
            <?php endif; ?>
        </div>

    <?php endforeach ?>
</div>

<style>

.partners-galerie{
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 100px;
}

.partners-containerImage{
    width: 180px;
    height: 180px;
    border: solid black 1px;
    margin: 5px;
    background-color: #d4d4d4;
}

.partners-Image{
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