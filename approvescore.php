<?php
require_once('authorize.php');
require_once('config.php');

if (isset($_GET['id']) && isset($_GET['date']) && isset($_GET['name']) && isset($_GET['score']) && isset($_GET['screenshot'])) {
    // Grab the score data from the GET
    $id = $_GET['id'];
    $date = $_GET['date'];
    $name = $_GET['name'];
    $score = $_GET['score'];
    $screenshot = $_GET['screenshot'];

    // Connect to the database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
    or die('Cant connect to DB');

    // Approve score
    $query = "UPDATE guitarwars SET approved=1 WHERE id = $id";
    $data = mysqli_query($dbc, $query)
    or die('Cant execute query');

    mysqli_close($dbc);

    echo <<<T_START_HEREDOC
    Рейтинг подтвержден:
    <table>
    <tr><td><strong>id</strong>
    <td><strong>Name</strong>
    <td><strong>Score</strong>
    <td><strong>Screenshot</strong>
    <td><strong>Date</strong></tr>

T_START_HEREDOC;
    echo '<tr><td>' . $id . '</td>';
    echo '<td>' . $name . '</td>';
    echo '<td>' . $score . '</td>';
    echo '<td>' . $screenshot . '</td>';
    echo '<td>' . $date . '</td></tr></table>';

    echo '<p><a href="admin.php">&lt;&lt; Back to admin page</a></p>';
} else {
    echo '<p class="error">Извините, не выбран рейтинг для подтверждения.</p>';
    echo '<p><a href="admin.php">&lt;&lt; Back to admin page</a></p>';
}


