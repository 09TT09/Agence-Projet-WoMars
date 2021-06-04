<?php require_once '../../../database/mariadb.php'?>
<?php
    if (isset($_GET['id'])){
        $sql =$db->prepare("DELETE FROM articles WHERE Id=:id");
        $sql->bindParam(":id",$_GET['id'],PDO::PARAM_INT);
        $sql->execute();
        header("location:../../pages/back-office.php?page=Articles");
        exit();
    } else {
        header("location:../../pages/back-office.php?page=Articles&?error=unknown");
        exit();
    }
?>