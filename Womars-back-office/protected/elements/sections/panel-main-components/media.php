<form action="../traitement/fileTransfert.php" method="post" enctype="multipart/form-data">
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
</form>

<?php
    $req = $db->query('SELECT * FROM images ORDER BY id DESC'); 
    $allimages = $req->fetchAll();
    foreach ($allimages as $image):
?>

  <img src="../media/<?= $image['name'] ?>" style="width:100px; border: solid crimson 2px;"/>

<?php endforeach ?>