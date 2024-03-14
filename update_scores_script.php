<?php
    require_once "db_connect.php";

    $teams=mysqli_query($db, "SELECT * FROM `teams`");
    $teams=mysqli_fetch_all($teams);

    $truncate_table=mysqli_query($db, "TRUNCATE TABLE `users_tournament`");

    foreach($teams as $team){
        $insert_data=mysqli_query($db, "INSERT INTO `users_tournament` (`teamname`, `teamscore`, `teampic`) VALUES ('$team[3]', '$team[4]', '$team[5]')");
    }
?>