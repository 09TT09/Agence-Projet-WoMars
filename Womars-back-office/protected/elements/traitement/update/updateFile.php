<?php require_once '../../../database/mariadb.php'?>
<?php
    if(isset($_POST['update'])){
        $sql = $db->prepare("UPDATE images SET name=:name, caption=:caption, alt=:alt WHERE id=:id");
        $sql->bindParam(':name', $_POST["name"]);
        if ($_POST['caption'] !== ''){ $sql->bindParam(':caption', $_POST["caption"]); }
        else { $sql->bindValue(':caption', null, PDO::PARAM_NULL); }
        if ($_POST['alt'] !== ''){ $sql->bindParam(':alt', $_POST["alt"]); }
        else { $sql->bindValue(':alt', null, PDO::PARAM_NULL); }
        $sql->bindValue(":id",$_GET['id'],PDO::PARAM_INT);
        $sql->execute();
        header("location:../../pages/back-office.php?page=Media");
        exit();
    } else {
        header("location:../../pages/back-office.php?page=Media&?error=unknown");
        exit();
    }
?>