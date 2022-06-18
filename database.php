<?php

$hostname = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'db_seeder';

$connect = mysqli_connect($hostname, $username, $password, $database) or die('Query Error: '.mysqli_connect_error($conn));

?>