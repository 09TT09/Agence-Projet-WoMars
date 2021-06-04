<?php require_once '../../../database/mariadb.php'?>
<?php

    if (!empty($_FILES["fileToUpload"]["tmp_name"])){

        $target_file = "../../media/partners/" . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) { $uploadOk = 1; }
            else { $uploadOk = 0; header("location:../../pages/back-office.php?page=Partners&errorPartners=error7"); exit(); }
        }

        if (file_exists($target_file)) {
            $uploadOk = 0;
            header("location:../../pages/back-office.php?page=Partners&errorPartners=error3");
            exit();
        }

        if ($_FILES["fileToUpload"]["size"] > 500000) {
            $uploadOk = 0;
            header("location:../../pages/back-office.php?page=Partners&errorPartners=error4");
            exit();
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            $uploadOk = 0;
            header("location:../../pages/back-office.php?page=Partners&errorPartners=error5");
            exit();
        }

        if ($uploadOk === 0) {
            header("location:../../pages/back-office.php?page=Partners&errorPartners=error6");
            exit();
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $nullConst = null;
                $sql = $db->prepare("INSERT INTO partners (name, size, type, caption, alt) VALUES (:name, :size, :type, :caption, :alt)");
                $sql->bindParam(':name', $_FILES["fileToUpload"]["name"]);
                $sql->bindParam(':size', $_FILES["fileToUpload"]["size"]);
                $sql->bindParam(':type', $_FILES["fileToUpload"]["type"]);
                $sql->bindParam(':caption', $nullConst);
                $sql->bindParam(':alt', $nullConst);
                $sql->execute();
                header("location:../../pages/back-office.php?page=Partners");
                exit();
            }
            else { header("location:../../pages/back-office.php?page=Partners&errorPartners=error2"); exit(); }
        }
    }
    else { header("location:../../pages/back-office.php?page=Partners&errorPartners=error1"); exit(); }
?>