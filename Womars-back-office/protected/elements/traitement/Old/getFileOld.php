<?php require_once "../../../database/mariadb.php" ?>
<?php
    $req = $db->prepare("SELECT * FROM images WHERE id=? LIMIT 1"); 
    $req->setFetchMode(PDO::FETCH_ASSOC);
    $req->execute(array($_GET["id"]));
    $tab = $req->fetchAll();
    echo $tab[0]["bin"];
?>