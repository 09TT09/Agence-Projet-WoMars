<form action="../traitement/fileTransfert.php" method="post" enctype="multipart/form-data">
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
</form>

<div class="media-galerie" id="galerie">

  <?php
      $req = $db->query('SELECT * FROM images ORDER BY id DESC'); 
      $allimages = $req->fetchAll();
      foreach ($allimages as $image):
  ?>

    <div class="media-containerImage" onclick="editImage(this)" id="containerImage-<?= $image['id'] ?>">
      <img class="media-Image" src="../media/<?= $image['name'] ?>" id="image-<?= $image['id'] ?>"/>
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
}

.media-get-Image{
  height: 100%;
  width: 100%;
  object-fit: contain;
}

</style>