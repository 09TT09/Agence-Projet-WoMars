<?php require_once '../../../database/mariadb.php'?>
<?php
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $req = $db->query('SELECT * FROM images WHERE id ='.$id);
        $image = $req->fetchObject();
    }
?>

<p id="xhr-imageid"><?php echo htmlspecialchars($image->id, ENT_QUOTES, 'UTF-8') ?></p>
<p id="xhr-imagealt"><?php echo htmlspecialchars($image->alt, ENT_QUOTES, 'UTF-8') ?></p>
<p id="xhr-imagename"><?php echo htmlspecialchars($image->name, ENT_QUOTES, 'UTF-8') ?></p>
<p id="xhr-imagecaption"><?php echo htmlspecialchars($image->caption, ENT_QUOTES, 'UTF-8') ?></p>
