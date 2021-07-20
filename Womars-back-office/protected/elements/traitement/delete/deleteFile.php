<?php require_once '../../../database/mariadb.php'?>
<?php 
    if (isset($_GET['id'], $_GET['name'])){
        unlink('../../media/media/'.$_GET['name']);
        $sql =$db->prepare("DELETE FROM images WHERE id=:id");
        $sql->bindParam(":id",$_GET['id'],PDO::PARAM_INT);
        $sql->execute();
        header("location:../../pages/back-office.php?page=Media");
        exit();
    } else {
        header("location:../../pages/back-office.php?page=Media&?error=unknown");
        exit();
    }
?>