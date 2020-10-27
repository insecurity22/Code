<?php

    $host = 'localhost';
    $user = 'id';
    $pw = 'pw';
    $dbName = 'dbname';

    $conn = mysqli_connect($host, $user, $pw, $dbName) or die(" Couldn't connect");
    if($conn) {
        // echo "connect 성공";
    } else {
        // echo "disconnect 실패";
    }

?>
