<?php

try{
    $db = new PDO('mysql:host=localhost;dbname=womars;charset=utf8', 'root', '');
}
catch(Exception $error){
    die('Erreur : '.$error->getMessage());
}
?>