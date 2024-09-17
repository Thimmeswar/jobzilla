<?php
$host = 'localhost';
$user = 'root';
$pass = ''; // Empty password for default XAMPP setup
$dbname = 'jobzilla';

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}
?>
