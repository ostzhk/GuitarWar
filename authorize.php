<?php
$user = '1';
$pass = '1';

if(!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])
    || $_SERVER['PHP_AUTH_USER'] != $user || $_SERVER['PHP_AUTH_PW'] != $pass){
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="Guitar War"');
    exit('<h2>Гитарные войны</h2>Извините, вы должны ввести правильный логин и пароль' .
        '<p><a href="index.php">&lt;&lt; Вернуться на  главную страницу</a></p>');
}
?>