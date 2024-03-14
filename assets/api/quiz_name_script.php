<?php
    require_once "db_connect.php";

    $name=mysqli_query($db, "SELECT `quiz_name` FROM `quiz` WHERE `id`=1");
    $name=mysqli_fetch_all($name);

    $quiz_name=$name[0][0];
?>