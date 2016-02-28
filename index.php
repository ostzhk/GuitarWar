<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Guitar Wars - High Scores</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
<h2>Guitar Wars - High Scores</h2>
<p>Добро пожаловать на портал Guitar Wars! Вы гитарист? Если да, <a href="addscore.php">добавьте свой рекорд</a>.</p>
<hr/>

<?php
require_once('config.php');
// Connect to the database
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
or die('Cant connect to DB');

// Retrieve the score data from MySQL
$query = "SELECT * FROM guitarwars";
$data = mysqli_query($dbc, $query)
or die('Cant execute query');

// Loop through the array of score data, formatting it as HTML
echo '<table>';
while ($row = mysqli_fetch_array($data)) {
    // Display the score data
    echo '<tr><td class="scoreinfo">';
    echo '<span class="score">' . $row['score'] . '</span><br />';
    echo '<strong>Name:</strong> ' . $row['name'] . '<br />';
    echo '<strong>Date:</strong> ' . $row['date'] . '<br />';
    if (is_file(GW_UPLOADPATH . $row['screenshot']) && filesize(GW_UPLOADPATH . $row['screenshot']) > 0) {
        echo '<img src=\'' . GW_UPLOADPATH . $row['screenshot'] . '\' alt="Подтверждено"/>' . '<hr/></td></tr>';
    } else {
        echo '<img src=\'' . GW_UPLOADPATH . 'unverified.gif\' alt="Не подтверждено"/><hr/></td></tr>';
    }
}
echo '</table>';

mysqli_close($dbc);
?>

</body>
</html>
