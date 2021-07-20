<?php
    if(isset($_GET['id'])){
        $req = $db->query('SELECT * FROM articles WHERE id ='.$_GET['id']);
        $article = $req->fetchObject();
		$dateTime = explode(" ", $article->date);
    }
?>
<div style="text-align:center;width:100%; margin: 151px auto 0 auto;">
    <h2><?php echo htmlspecialchars($article->title, ENT_QUOTES, 'UTF-8') ?></h2>
    <?php if ($article->state === "1"): ?>
        <p style="color:lime">Published</p>
    <?php else: ?>
        <p style="color:crimson">Not published</p>
    <?php endif; ?>
    <p>Realized by <?php echo htmlspecialchars($article->author, ENT_QUOTES, 'UTF-8') ?><br><br>
    On <?php echo htmlspecialchars($dateTime[0], ENT_QUOTES, 'UTF-8') .' at '. htmlspecialchars($dateTime[1], ENT_QUOTES, 'UTF-8') ?></p>

    <br><hr><br><br>

    <form action="../traitement/update/updateArticle.php?id=<?php echo htmlspecialchars($article->id, ENT_QUOTES, 'UTF-8') ?>" method="POST" class="editarticle-form">

        <div class="editarticle-formstate">
            <label for="state">When updated, publish the article : </label>
            <input type="checkbox" name="state" id="publishState" class="editarticle-formcheckbox" value="setonline">
            <span id="publishStateInfo" class="editarticle-publishstateinfo">No</span>
        </div>

        <div class="createarticle-formimage">
            <?php if(htmlspecialchars($article->imageid, ENT_QUOTES, 'UTF-8') === ""): ?>
                <div class="createarticle-formimagecontainer" id="formimagecontainer">
                    <p>Choose an image</p>
                </div>
            <?php else: ?>

                <?php
                    $req = $db->query('SELECT * FROM images WHERE id =' . $article->imageid);
                    $imageMedia = $req->fetchObject();
                ?>

                <?php if($imageMedia !== False): ?>
                    <div class="createarticle-formimagecontainer" id="formimagecontainer">
                        <img class="createarticle-Image" src="../media/media/<?php echo htmlspecialchars($imageMedia->name, ENT_QUOTES, 'UTF-8') ?>"  alt="<?php echo htmlspecialchars($imageMedia->alt, ENT_QUOTES, 'UTF-8') ?>" id="image-<?php echo htmlspecialchars($imageMedia->id, ENT_QUOTES, 'UTF-8') ?>" />
                    </div>
                <?php else: ?>
                    <div class="createarticle-formimagecontainer" id="formimagecontainer">
                        <p style="color:crimson;">Image Error</p>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="editarticle-infoform">
            <label for="title" class="formlabel">Title</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($article->title, ENT_QUOTES, 'UTF-8') ?>" class="forminput" />

            <label for="author" class="formlabel">Author</label>
            <input type="text" name="author" value="<?php echo htmlspecialchars($article->author, ENT_QUOTES, 'UTF-8') ?>" class="forminput" />
        </div>
        <div class="editarticle-infoform">
            <label for="description" class="formlabel">Description</label>
            <textarea name="description" class="formtextarea"><?php echo htmlspecialchars($article->description, ENT_QUOTES, 'UTF-8') ?></textarea>
        </div>

        <div>
            <label for="article-textarea" class="formlabel">Text</label>
            <textarea name="text" class="formtextarea-text" id="article-textarea"><?php echo htmlspecialchars($article->text, ENT_QUOTES, 'UTF-8') ?></textarea>
        </div><br><br>

        <input type="hidden" id="hiddenImageId" name="imageid" value="empty" />
        <div id="getXHR" style="display:none;"></div>

        <input type="submit" value="Update" name="update" class="article-button article-button-params">

    </form>

    <button onclick="location.href='../traitement/delete/deleteArticle.php?id=<?php echo htmlspecialchars($article->id, ENT_QUOTES, 'UTF-8') ?>'" class="article-button-delete">Delete</button>
</div>

<script>
let getArticleImageId = "<?php echo htmlspecialchars($article->imageid, ENT_QUOTES, 'UTF-8') ?>";

if (getArticleImageId !== ""){
  document.getElementById('hiddenImageId').value = getArticleImageId;
}

document.getElementById('formimagecontainer').addEventListener('click', function (event) {
  document.getElementById('wysiwyg-getImage').style.display = 'flex';
});

document.getElementById('exit').addEventListener('click', function (event) {
  document.getElementById('wysiwyg-getImage').style.display = "none";
});

document.getElementById('publishState').addEventListener('click', function (event) {
  if (document.getElementById('publishState').checked === false){
    document.getElementById('publishStateInfo').innerHTML = "No";
    document.getElementById('publishStateInfo').style.color = "crimson";
  } else {
    document.getElementById('publishStateInfo').innerHTML = "Yes";
    document.getElementById('publishStateInfo').style.color = "lime";
  }
});

function selectedImage(imageId){
  const idSplit = imageId.id.split('-');
  document.getElementById('wysiwyg-getImage').style.display = "none";
  let xhttp = new XMLHttpRequest();
  xhttp.open('POST', 'xhr/post-id-articlecreate.php', true);
  xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState == 4 && xhttp.status == 200) {
      document.getElementById('getXHR').innerHTML = xhttp.responseText;
      let getImageId = document.getElementById('xhr-imageid').innerHTML;
      let getImageName = document.getElementById('xhr-imagename').innerHTML;
      let getImageCaption = document.getElementById('xhr-imagecaption').innerHTML;
      let getImageAlt = document.getElementById('xhr-imagealt').innerHTML;
      const imageEnd = '<img class="createarticle-Image" src="../media/media/' + getImageName + '"  alt="' + getImageAlt + '" id="image-' + getImageId + '" />'
      document.getElementById('formimagecontainer').innerHTML = imageEnd;
      document.getElementById('hiddenImageId').value = getImageId;
    }
  }
  xhttp.send('id='+idSplit[1]);
}

</script>

<style>

.createarticle-formimage{
    width: 100%;
    margin-bottom: 40px;
    font-size: 20px;
    color: black;
}

.createarticle-formimagecontainer{
    display: flex;
    justify-content: center;
    align-items: center;
    width: 200px;
    height: 200px;
    background-color: #d4d4d4;
    cursor: pointer;
    margin: auto;
}

.createarticle-Image{
    height: 100%;
    width: 100%;
    object-fit: contain;
    font-size: 16px;
}









.editarticle-formstate{
    width: 100%;
    margin-bottom: 40px;
    font-size: 20px;
}

.editarticle-formcheckbox{
    width: 18px;
    height: 18px;
    cursor: pointer;
    vertical-align: middle;
}

.editarticle-publishstateinfo{
  color: crimson;
}






















.formlabel{
    display: block;
    margin-bottom: 5px;
    font-size: 20px;
}

.forminput{
    margin-bottom: 30px;
    width: 100%;
    height: 35px;
    font-size: 20px;
}

.formtextarea{
    display: block;
    margin: auto;
    margin-bottom: 30px;
    width: 100%;
    height: 135px;
    font-size: 16px;
}

.formtextarea-text{
    width: 60%;
    height: 200px;
    font-size: 16px;
}











.editarticle-form{
    text-align: center;
}

.editarticle-infoform{
    display: inline-flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 40%;
    padding: 0 10px;
}

.article-title{
    width: 100%;
    font-size: 22px;
}

.article-textarea{
    margin: auto;
    width: 70%;
    height: 100px;
    min-width: 70%;
    max-width: 70%;
    min-height: 24px;
    border: 0;
    padding: 0 5px;
    border-top: solid black 2px;
    border-bottom: solid black 2px;
    background-color: #FFFFFF;
    color: black;
    font-size: 20px;
    font-family: Montserrat-Regular, Arial, sans-serif;
    vertical-align: top;
}

.article-input{
    width: 100%;
    padding: 0 5px;
    margin: 0;
    height: 40px;
    border: 0;
    font-size: 26px;
    text-align: center;
    font-family: Montserrat-Regular, Arial, sans-serif;
}

.article-button{
    width: 150px;
    height: 32px;
    font-size: 16px;
    vertical-align: middle;
    background-color: #F37C26;
    border: 0;
    border-radius: 50px;
    color: white;
    cursor: pointer;
    transition: .25s;
    margin-bottom: 50px;
}

.article-button-params{
    margin-bottom: 20px;
}

.article-button:hover, .article-button-delete:hover{
    transform: scale(1.1,1.1);
}


.article-button-delete{
    width: 150px;
    height: 32px;
    font-size: 16px;
    vertical-align: middle;
    background-color: crimson;
    border: 0;
    border-radius: 50px;
    color: white;
    cursor: pointer;
    transition: .25s;
    margin-bottom: 100px;
}












.wysiwyg-getImage{
    position: fixed; 
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 10;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.7);
}

.wysiwyg-getImageDiv{
    width: 80%;
    height: 90vh;
    background-color: white;
    color: black;
    overflow: auto;
}
    
.parameters-exit{
    display: inline-block;
    width: 45px;
    height: 45px;
    margin-right: 30px;
    color: white;
    background-color: crimson;
    border: 0;
    cursor: pointer;
    font-size: 18px;
    transition: 0.25s;
}

.parameters-exit:hover{
    background-color: #ae0021;
}

.createarticle-allImageContainer{
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    width: 100%;
    height: auto;
}

.createarticle-containerImage{
    display: inline-block;
    width: 200px;
    height: 200px;
    border: solid black 1px;
    margin: 5px;
    background-color: #d4d4d4;
    cursor: pointer;
}

.createarticle-Image{
    height: 100%;
    width: 100%;
    object-fit: contain;
    font-size: 16px;
}

</style>