<?php require_once '../../../database/mariadb.php'?>
<?php
    echo $_POST['text'];
    if(isset($_POST['update'])){
        $sql = $db->prepare("UPDATE articles SET title=:title, author=:author, description=:description, text=:text WHERE id=:id");
        $sql->bindParam(':title', $_POST["title"]);
        $sql->bindParam(':author', $_POST["author"]);
        $sql->bindParam(':description', $_POST["description"]);
        $sql->bindParam(':text', $_POST["text"]);
        $sql->bindParam(":id",$_GET['id'],PDO::PARAM_INT);
        $sql->execute();
        //header("location:../../pages/back-office.php?page=Articles");
        exit();
	} else {
        //header("location:../../pages/back-office.php?page=Articles&?error=unknown");
        exit();
    }
?>