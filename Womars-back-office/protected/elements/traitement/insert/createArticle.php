<?php require_once '../../../database/mariadb.php'?>
<?php

    $textAreas = array($_POST['title'], $_POST['author'], $_POST['description'], $_POST['text']);

    foreach($textAreas as $textArea) {
        if(preg_match('/(<\?|<script>|<html>)/', $textArea)){
            echo 'hey';
            header("location:../../pages/back-office.php?page=Articles&error=forbiddenwords");
            exit();
        }
    }

    if(isset($_POST['send'])){
        if (isset($_POST['state'])) { $stateValue = 1; }
        else { $stateValue = 0; }
        $sql = $db->prepare("INSERT INTO articles (title, author, description, text, state, imageid) VALUES (:title, :author, :description, :text, :state, :imageid)");
        $sql->bindParam(':title', $_POST["title"]);
        $sql->bindParam(':author', $_POST["author"]);
        $sql->bindParam(':description', $_POST["description"]);
        $sql->bindParam(':text', $_POST["text"]);
        $sql->bindParam(':state', $stateValue, PDO::PARAM_INT);
        if ($_POST["imageid"] !== 'empty') { $sql->bindParam(':imageid', $_POST["imageid"], PDO::PARAM_INT); }
        else { $sql->bindValue(':imageid', null, PDO::PARAM_NULL); }
        $sql->execute();
        header("location:../../pages/back-office.php?page=Articles");
	} else {
        header("location:../../pages/back-office.php?page=Articles&?error=unknown");
    }
?>