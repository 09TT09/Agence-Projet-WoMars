<?php
    header('WWW-Authenticate: Basic realm="Protected area"');
    header('HTTP/1.0 401 Unauthorized');
    //header('Location: http://localhost/Womars-back-office');
?>