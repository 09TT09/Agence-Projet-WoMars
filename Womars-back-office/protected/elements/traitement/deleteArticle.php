<?php require_once '../../database/mariadb.php'?>
<?php
    $id = $_GET['id'];
    $sql =$db->prepare("DELETE FROM articles WHERE Id=:id");
    $sql->bindParam(":id",$id,PDO::PARAM_INT);
    $sql->execute();
    header("location:../pages/back-office.php?page=Articles");
?>