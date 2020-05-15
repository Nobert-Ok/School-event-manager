<?php

if (!isset($_SESSION)) {
	session_start();
}
//connect to db
$dbhost = "localhost";// this will ususally be 'localhost', but can sometimes differ
$dbname = "alusm";// the name of the database that you are going to use for this project
$dbuser = "root";// the username that you created, or were given, to access your database
$dbpass = "";// the password that you created, or were given, to access your database

$conn      = mysqli_connect($dbhost, $dbuser, $dbpass) or die("MySQL Error with $conn on base.php: " .mysql_error());
$db_select = mysqli_select_db($conn, $dbname) or die("MySQL Error with $db_select on base.php: " .mysql_error());

if (!$db_select) {
	echo "Could not select database";
}

if (!$conn) {
	echo "Could not connect.";
}

?>