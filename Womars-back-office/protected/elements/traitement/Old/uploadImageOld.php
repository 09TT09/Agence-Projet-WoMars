<?php 
    if(isset($_POST['sendimage'])){
        $req = $db->prepare("INSERT INTO images (name, size, type, bin) VALUES (?, ?, ?, ?)");
        $req->execute(array($_FILES["image"]["name"], $_FILES["image"]["size"], $_FILES["image"]["type"], file_get_contents($_FILES["image"]["tmp_name"])));
	}
?>	