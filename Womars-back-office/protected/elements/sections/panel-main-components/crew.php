<div class="crew-divform">
    <form action="../traitement/insert/imageTransfertCrew.php" method="post" enctype="multipart/form-data">

        <label for="personname" class="crew-formlabel">Name</label>
        <input type="text" name="personname" value="" class="crew-forminput" />

        <label for="profession" class="crew-formlabel">Profession</label>
        <input type="text" name="profession" value="" class="crew-forminput" />

        <label for="biography" class="crew-formlabel">Biography</label>
        <textarea name="biography" class="crew-formtextarea"></textarea>

        <div class="crew-formuploadimage">
            <input type="file" name="fileToUpload" id="fileToUpload" class="crew-inputfileToupload">
            <input type="submit" value="Upload" name="submit" class="crew-validateForm">
        </div>

    </form>
</div>

<?php
    if(isset($_GET['errorCrew'])){
        $error = $_GET['errorCrew'];
        $errorText;
        if ($error === 'error1'){$errorText = 'No file chosen';}
        if ($error === 'error2'){$errorText = "An error occured when uploading your file.";}
        if ($error === 'error3'){$errorText = "Your file already exists.";}
        if ($error === 'error4'){$errorText = "Your file is too large.";}
        if ($error === 'error5'){$errorText = "Only JPG, JPEG, PNG & GIF files are allowed.";}
        if ($error === 'error6'){$errorText = "Sorry, your file was not uploaded.";}
        if ($error === 'error7'){$errorText = "File is not an image.";}
        if ($error === 'error8'){$errorText = "The width and the height of the image must be the same";}
    }
?>

<?php if (isset($_GET['errorCrew'])): ?>
    <div class="divErrorCases">
        Error : <?php echo htmlspecialchars($errorText, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif ?>

<div class="taille-image-div">
    <div class="taille-image-title">Image display size :</div>
    <button id="tailleMoins">-</button>
    <button id="taillePlus">+</button>
</div>

<div class="crew-galerie" id="galerie">
    <?php
        $req = $db->query('SELECT * FROM crew ORDER BY id DESC'); 
        $allcrew = $req->fetchAll();
        foreach ($allcrew as $crew):
    ?>

        <div class="crew-containerImage" onclick="editImage(this)" id="containerImage-<?php echo htmlspecialchars($crew['id'], ENT_QUOTES, 'UTF-8') ?>">
            <?php if (file_exists('../media/crew/'.$crew['name']) === false): ?>
                <div class="error">
                    <p>This image was not found in the "crew" folder.<br><br> Please, delete the path with the image parameters window</p>
                </div>
            <?php else: ?>
                <img class="crew-Image" src="../media/crew/<?php echo htmlspecialchars($crew['name'], ENT_QUOTES, 'UTF-8') ?>" alt="<?php echo htmlspecialchars($crew['alt'], ENT_QUOTES, 'UTF-8') ?>" id="image-<?php echo htmlspecialchars($crew['id'], ENT_QUOTES, 'UTF-8') ?>"/>
            <?php endif; ?>
        </div>

    <?php endforeach ?>
</div>

<style>

.crew-divform{
    width: 80%;
    height: auto;
    margin: auto;
    font-size: 22px;
}

.crew-formlabel{
    display: block;
    margin-bottom: 5px;
}

.crew-forminput{
    margin-bottom: 30px;
    width: 100%;
    height: 25px;
}

.crew-formtextarea{
    display: block;
    margin: auto;
    margin-bottom: 30px;
    width: 100%;
    height: 200px;
}

.crew-formuploadimage{
    display: flex;
    justify-content: center;
    width: 100%;
    height: auto;
}

.crew-inputfileToupload{
    float: left;
    cursor: pointer;
}

.crew-validateForm{
    float: right;
    width: 150px;
    height: 32px;
    font-size: 16px;
    background-color: #F37C26;
    border: 0;
    color: white;
    cursor: pointer;
    transition: .25s;
}

.crew-validateForm:hover{
    background-color: #d37029;
}

.crew-galerie{
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 100px;
}

.crew-containerImage{
    width: 180px;
    height: 180px;
    border: solid black 1px;
    margin: 5px;
    background-color: #d4d4d4;
}

.crew-Image{
    height: 100%;
    width: 100%;
    object-fit: contain;
    font-size: 16px;
}

.allmedia-get-Image{
    max-width: 100%;
    max-height: 100%;
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
    margin-top: 20px;
    overflow: auto;
    color: crimson;
    font-size: 18px;
}

.taille-image-div{
    margin-top: 30px;
}

.taille-image-title{
    font-size: 18px;
}

@media screen and (max-width: 750px) {
    .crew-containerImage{
        width: 130px;
        height: 130px;
        max-width: 300px;
        min-width: 100px;
    }
}

</style>