<?php
require_once "db_connect.php";

if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
    
    if ($sort === 'alphabetical') {
        $teams_sorted = mysqli_query($db, "SELECT * FROM `teams` ORDER BY `teamname` ASC");
        $teams_sorted=mysqli_fetch_all($teams_sorted);
    } else if ($sort === 'points') {
        $teams_sorted = mysqli_query($db, "SELECT * FROM `teams` ORDER BY `teamscore` DESC");
        $teams_sorted=mysqli_fetch_all($teams_sorted);
    }

    $html = '<table class="table">';
    $html .= '<thead><tr><th>#</th><th>Команда</th><th>Счет</th></tr></thead>';
    $html .= '<tbody>';
    $i = 1;
    foreach($teams_sorted as $team_sorted) {
        if ($team_sorted[0] == 555 || $team_sorted[0] == 666 || $team_sorted[0] == 777) {
            continue;
        }
        $html .= '<tr>';
        $html .= '<td>' . $i . '</td>';
        $html .= '<td>' . $team_sorted[3] . '</td>';
        $html .= '<td>' . $team_sorted[4] . '</td>';
        $html .= '</tr>';
        $i++;
    }
    $html .= '</tbody>';
    $html .= '</table>';
    echo $html;
}
?>
