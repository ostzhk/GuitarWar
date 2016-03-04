<?php
require_once ('authorize.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//Tenderised.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Guitar Wars - Admin Panel</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
<h2>Admin Panel</h2>
<hr/>
<?php
require_once ('config.php');

// Connect to the database
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
or die('Cant connect to DB');

// Retrieve the score data from MySQL
$query = "SELECT * FROM guitarwars ORDER BY date ";
$data = mysqli_query($dbc, $query)
or die('Cant execute query');

// Loop through the array of score data, formatting it as HTML
echo '<table>';
while($row = mysqli_fetch_array($data)){
echo '<tr class="scorerow"><td>' . $row['id'] . '</td>';
echo '<td>' . $row['name'] . '</td>';
echo '<td>' . $row['score'] . '</td>';
echo '<td>' . $row['date'] . '</td>';
echo '<td>' . $row['screenshot'] . '</td>';
echo '<td><a href="removescore.php?id=' . $row['id'] . '&amp;date=' . $row['date'] . '&amp;name=' . $row['name'] .
'&amp;score=' . $row['score'] . '&amp;screenshot=' . $row['screenshot'] . '">Удалить</a></td>';
    if($row['approved']==0){
        echo '<td><a href="approvescore.php?id=' . $row['id'] . '&amp;name=' . $row['name'] .
            '&amp;score=' . $row['score'] . '">Подтвердить</a></td></tr>';
    }else{
        echo '</tr>';
    }
}
echo '</table>';
mysqli_close($dbc);
?>
</body>
</html>
