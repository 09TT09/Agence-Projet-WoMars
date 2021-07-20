<?php require_once '../../../database/mariadb.php'?>
<?php
    if(isset($_POST['update'])){
        if(isset($_GET['id'])){
            $req = $db->query('SELECT * FROM images WHERE id ='.$_GET['id']);
            $image = $req->fetchObject();
        }
        if (file_exists('../../media/media/'.$_POST["name"]) && $image->name != $_POST["name"]) {
            header("location:../../pages/back-office.php?page=Media&?error=doesexist");
            exit();
        }
        else{
            $fullImageName = explode(".", $_POST["name"]);
            $fileExtension = end($fullImageName);
            if ($fileExtension != 'jpg' && $fileExtension != 'png' && $fileExtension != 'jpeg' && $fileExtension != 'gif'){
                $getFileExtension = explode("/", $image->type);
                $endExplodedExtension = ".".end($getFileExtension);
                rename('../../media/media/'.$image->name, '../../media/media/'.$_POST["name"].$endExplodedExtension);
                $postName = $_POST["name"].$endExplodedExtension;
            }
            else {
                rename('../../media/media/'.$image->name, '../../media/media/'.$_POST["name"]);
                $postName = $_POST["name"];
            }

            $sql = $db->prepare("UPDATE images SET name=:name, caption=:caption, alt=:alt WHERE id=:id");
            $sql->bindParam(':name', $postName);
            if ($_POST['caption'] !== ''){ $sql->bindParam(':caption', $_POST["caption"]); }
            else { $sql->bindValue(':caption', null, PDO::PARAM_NULL); }
            if ($_POST['alt'] !== ''){ $sql->bindParam(':alt', $_POST["alt"]); }
            else { $sql->bindValue(':alt', null, PDO::PARAM_NULL); }
            $sql->bindValue(":id",$_GET['id'],PDO::PARAM_INT);
            $sql->execute();
            header("location:../../pages/back-office.php?page=Media");
            exit();
        }
    } else {
        header("location:../../pages/back-office.php?page=Media&?error=unknown");
        exit();
    }
?>