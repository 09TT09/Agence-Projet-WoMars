<?php require_once '../../../database/mariadb.php'?>
<?php

    $textAreas = array($_POST['title'], $_POST['author'], $_POST['description'], $_POST['text']);

    foreach($textAreas as $textArea) {
        if(preg_match('/(<?|<script>|<html>)/',$textArea)){
            header("location:../../pages/back-office.php?page=Articles&error=code");
            exit();
        }
    }

    if(isset($_POST['send'])){
        $sql = $db->prepare("INSERT INTO articles (title, author, description, text) VALUES (:title, :author, :description, :text)");
        $sql->bindParam(':title', $_POST["title"]);
        $sql->bindParam(':author', $_POST["author"]);
        $sql->bindParam(':description', $_POST["description"]);
        $sql->bindParam(':text', $_POST["text"]);
        $sql->execute();
        header("location:../../pages/back-office.php?page=Articles");
	} else {
        header("location:../../pages/back-office.php?page=Articles&?error=unknown");
    }
?>