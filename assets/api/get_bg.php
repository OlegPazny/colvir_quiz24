<?php
    require_once "db_connect.php";

    $bg=mysqli_query($db, "SELECT `background` FROM `quiz`");
    $bg=mysqli_fetch_all($bg);

    $bg=$bg[0][0];
?>