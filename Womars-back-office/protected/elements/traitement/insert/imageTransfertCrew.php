<?php require_once '../../../database/mariadb.php'?>
<?php

    if (!empty($_FILES["fileToUpload"]["tmp_name"])){

        $target_file = "../../media/crew/" . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            list($width, $height) = $check;
            if ($height !== $width){ $uploadOk = 0; header("location:../../pages/back-office.php?page=Crew&errorCrew=error8"); exit(); }
            else { $uploadOk = 1; }
            if ($check !== false) { $uploadOk = 1; }
            else { $uploadOk = 0; header("location:../../pages/back-office.php?page=Crew&errorCrew=error7"); exit(); }
        }

        if (file_exists($target_file)) {
            $uploadOk = 0;
            header("location:../../pages/back-office.php?page=Crew&errorCrew=error3");
            exit();
        }

        if ($_FILES["fileToUpload"]["size"] > 500000) {
            $uploadOk = 0;
            header("location:../../pages/back-office.php?page=Crew&errorCrew=error4");
            exit();
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            $uploadOk = 0;
            header("location:../../pages/back-office.php?page=Crew&errorCrew=error5");
            exit();
        }

        if ($uploadOk === 0) {
            header("location:../../pages/back-office.php?page=Crew&errorCrew=error6");
            exit();
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $nullConst = null;
                $sql = $db->prepare("INSERT INTO crew (name, size, type, caption, alt, personname, profession, biography) VALUES (:name, :size, :type, :caption, :alt, :personname, :profession, :biography)");
                $sql->bindParam(':name', $_FILES["fileToUpload"]["name"]);
                $sql->bindParam(':size', $_FILES["fileToUpload"]["size"]);
                $sql->bindParam(':type', $_FILES["fileToUpload"]["type"]);
                $sql->bindParam(':caption', $nullConst);
                $sql->bindParam(':alt', $nullConst);
                $sql->bindParam(':personname', $_POST["personname"]);
                $sql->bindParam(':profession', $_POST["profession"]);
                $sql->bindParam(':biography', $_POST["biography"]);
                $sql->execute();
                header("location:../../pages/back-office.php?page=Crew");
                exit();
            }
            else { header("location:../../pages/back-office.php?page=Crew&errorCrew=error2"); exit(); }
        }
    }
    else { header("location:../../pages/back-office.php?page=Crew&errorCrew=error1"); exit(); }
?>