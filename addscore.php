<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Guitar Wars - Add Your High Score</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
<h2>Guitar Wars - Добавьте свой рекорд</h2>

<?php
require_once('config.php');
if (isset($_POST['submit'])) {
    // Grab the score data from the POST
    $name = $_POST['name'];
    $score = $_POST['score'];
    $screenshot = $_FILES['screenshot']['name'];

    if (!empty($name) && !empty($score)) {
        if (!empty($screenshot)) {
            $target = GW_UPLOADPATH . $screenshot;
            move_uploaded_file($_FILES['screenshot']['tmp_name'], GW_UPLOADPATH . $screenshot);
        }
        // Connect to the database
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
        or die('Cant connect to DB');

        // Write the data to the database
        $query = "INSERT INTO guitarwars VALUES (0, NOW(), '$name', '$score', '$screenshot')";
        mysqli_query($dbc, $query)
        or die('Cant execute query');

        // Confirm success with the user
        echo '<p>Спасибо что добавили свой рекорд!</p>';
        echo '<p><strong>Name:</strong> ' . $name . '<br />';
        echo '<strong>Score:</strong> ' . $score . '</p>';
        if (!empty($screenshot)) {
            echo '<img src=\'' . $target . '\'/>';
        }
        echo '<p><a href="index.php">&lt;&lt; Вернуться к таблице рекордов</a></p>';

        // Clear the score data to clear the form
        $name = "";
        $score = "";
        $screenshot = "";

        mysqli_close($dbc);
    } else {
        echo '<p class="error">Пожалуйста, заполните полную информацию о своем рекорде.</p>';
    }
}
?>

<hr/>
<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="MAX_FILE_SIZE" value="102400"/>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php if (!empty($name)) echo $name; ?>"/><br/>
    <label for="score">Score:</label>
    <input type="text" id="score" name="score" value="<?php if (!empty($score)) echo $score; ?>"/><br/>
    <label for="screenshot">Screenshot:</label>
    <input type="file" id="screenshot" name="screenshot"/>
    <hr/>
    <input type="submit" value="Add" name="submit"/>
    <a href="index.php">Отмена</a>
</form>
</body>
</html>
