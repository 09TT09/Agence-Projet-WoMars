<div class="crew-divform">
    <form action="../traitement/insert/imageTransfertCrew.php" method="post" enctype="multipart/form-data">

        <div class="crew-infoform">
            <label for="personname" class="crew-formlabel">Name</label>
            <input type="text" name="personname" class="crew-forminput" />

            <label for="profession" class="crew-formlabel">Profession</label>
            <input type="text" name="profession" class="crew-forminput" />
        </div>

        <div class="crew-infoform">
            <label for="biography" class="crew-formlabel">Biography</label>
            <textarea name="biography" class="crew-formtextarea"></textarea>
        </div><br>

        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload" name="submit" class="crew-validateForm">

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

<hr>

<div class="crew-galerie" id="galerie">
    
    <?php
        $currentPage = (int)($_GET['imagepagecrew'] ?? 1);
        if ($currentPage <= 0){
            throw new Exception('wrong page number');
        }
        $counterRequest = $db->query("SELECT COUNT(id) FROM crew");
        $counter = intval($counterRequest->fetch()[0]);
        $imagePerPage = 30;
        $pages = intval(ceil($counter / $imagePerPage));
        if ($pages === 0){ $pages = 1; }
        if ($currentPage > $pages){
            throw new Exception('this page does not exist');
        }
        $offset = $imagePerPage * ($currentPage - 1);

        $req = $db->query("SELECT * FROM crew ORDER BY id DESC LIMIT $imagePerPage OFFSET $offset"); 
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

    <div style="width: 100%;">
        <?php if($currentPage > 1): ?>
            <button class="button-paging" onclick="window.location='back-office.php?page=Crew&imagepagecrew=<?php echo $currentPage - 1 ?>';">Page précédente</button>
        <?php endif ?>
        <?php if($currentPage < $pages): ?>
            <button class="button-paging" onclick="window.location='back-office.php?page=Crew&imagepagecrew=<?php echo $currentPage + 1 ?>';">Page suivante</button>
        <?php endif ?>
    </div>
</div>

<style>

.button-paging{
    width: 160px;
    height: 35px;
    background-color: #F37C26;
    color: white;
    border: 0;
    cursor: pointer;
    font-size: 16px;
    border-radius: 2px;
    transition: .25s;
}

.button-paging:hover{
    background-color: #d37029;
}

.crew-infoform{
    display: inline-flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 40%;
    padding: 0 10px;
}

hr{
    margin-bottom: 0;
    height: 0;
    border: 0;
    border-bottom: 1px solid #0A0623;
}

.crew-divform{
    width: 100%;
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
    height: 119px;
    max-width: 515px;
    min-width: 150px;
}

.crew-formuploadimage{
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: auto;
}

.crew-validateForm{
    width: 150px;
    height: 32px;
    font-size: 16px;
    background-color: #F37C26;
    border-radius: 2px;
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
    padding: 50px 0;
    min-height: 36px;
    background-color: #ffeadc;
}

.crew-containerImage{
    width: 180px;
    height: 180px;
    border: solid black 1px;
    margin: 5px;
    background-color: #d4d4d4;
    cursor: pointer;
}

.crew-Image{
    height: 100%;
    width: 100%;
    object-fit: contain;
    font-size: 16px;
}

.allmedia-get-Image{
    width: 80%;
    height: 100%;
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

.taille-image-div button{
    width: 30px;
    height: 30px;
    border-radius: 3px;
    border: 0;
    background-color: #F37C26;
    cursor: pointer;
    font-size: 20px;
    transition: 0.25s;
    color: white;
}

.taille-image-div button:hover{
    transform: scale(1.1, 1.1);
    background-color: #d37029;
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