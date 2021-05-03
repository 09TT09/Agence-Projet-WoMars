<?php

    $pdo = new PDO('sqlite:database.db');
    $statement = $pdo->query("SELECT * FROM articles");
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

    echo "<pre>";
    print_r($rows);
    echo "</pre>";