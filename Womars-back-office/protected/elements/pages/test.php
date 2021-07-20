<?php require_once '../../database/mariadb.php'; ?>
<?php

$counterRequest = $db->query("SELECT COUNT(id) FROM crew");
$counter = $counterRequest->fetch();
var_dump($counter);

?>