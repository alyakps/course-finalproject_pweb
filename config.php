<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'Aktual_Cendekia_Course';

$db = mysqli_connect($hostname, $username, $password, $database, $port);

if (!$db) {
    die('Database Gagal Terhubung :'. mysqli_connect_error());
}