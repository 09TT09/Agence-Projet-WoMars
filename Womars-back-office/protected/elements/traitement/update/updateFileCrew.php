<?php require_once '../../../database/mariadb.php'?>
<?php
    if(isset($_POST['update'])){
        $sql = $db->prepare("UPDATE crew SET name=:name, caption=:caption, alt=:alt, personname=:personname, profession=:profession, biography=:biography WHERE id=:id");
        $sql->bindParam(':name', $_POST["name"]);
        if ($_POST['caption'] !== ''){ $sql->bindParam(':caption', $_POST["caption"]); }
        else { $sql->bindValue(':caption', null, PDO::PARAM_NULL); }
        if ($_POST['alt'] !== ''){ $sql->bindParam(':alt', $_POST["alt"]); }
        else { $sql->bindValue(':alt', null, PDO::PARAM_NULL); }
        if ($_POST['personname'] !== ''){ $sql->bindParam(':personname', $_POST["personname"]); }
        else { $sql->bindValue(':personname', null, PDO::PARAM_NULL); }
        if ($_POST['profession'] !== ''){ $sql->bindParam(':profession', $_POST["profession"]); }
        else { $sql->bindValue(':profession', null, PDO::PARAM_NULL); }
        if ($_POST['biography'] !== ''){ $sql->bindParam(':biography', $_POST["biography"]); }
        else { $sql->bindValue(':biography', null, PDO::PARAM_NULL); }
        $sql->bindValue(":id",$_GET['id'],PDO::PARAM_INT);
        $sql->execute();
        header("location:../../pages/back-office.php?page=Crew");
        exit();
    } else {
        header("location:../../pages/back-office.php?page=Crew&?error=unknown");
        exit();
    }
?>