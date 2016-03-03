<?php
require_once ('authorize.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Guitar Wars - Approve a High Score</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<h2>Guitar Wars - Approve a High Score</h2>

<?php
require_once('config.php');

if (isset($_GET['id']) && isset($_GET['name']) && isset($_GET['score'])) {
    // Grab the score data from the GET
    $id = $_GET['id'];
    $name = $_GET['name'];
    $score = $_GET['score'];
}
else if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['score'])) {
    // Grab the score data from the POST
    $id = $_POST['id'];
    $name = $_POST['name'];
    $score = $_POST['score'];
}
else {
    echo '<p class="error">Извините, не выбран рейтинг для подтверждения.</p>';
}

if (isset($_POST['submit'])) {
    if ($_POST['confirm'] == 'Yes') {

        // Connect to the database
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
        or die('Cant connect to DB');

        // Delete the score data from the database
        $query = "UPDATE guitarwars SET approved=1 WHERE id = $id";
        mysqli_query($dbc, $query)
        or die('Cant execute query');
        mysqli_close($dbc);

        // Confirm success with the user
        echo '<p>Рейтинг ' . $score . ' ' . $name . ' успешно подтвержден.';
    }
    else {
        echo '<p class="error">Рейтинг не был подтвержден.</p>';
    }
}
else if (isset($id) && isset($name) && isset($score)) {
    echo '<p>Вы уверены, что хотите подтвердить данный ретинг?</p>';
    echo '<p><strong>Name: </strong>' . $name .
        '<br /><strong>Score: </strong>' . $score . '</p>';
    echo '<form method="post" action="approvescore.php">';
    echo '<input type="radio" name="confirm" value="Yes" /> Yes ';
    echo '<input type="radio" name="confirm" value="No" checked="checked" /> No <br />';
    echo '<input type="submit" value="Submit" name="submit" />';
    echo '<input type="hidden" name="id" value="' . $id . '" />';
    echo '<input type="hidden" name="name" value="' . $name . '" />';
    echo '<input type="hidden" name="score" value="' . $score . '" />';
    echo '</form>';
}

echo '<p><a href="admin.php">&lt;&lt; Back to admin page</a></p>';
?>

</body>
</html>



