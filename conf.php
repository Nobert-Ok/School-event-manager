<?php

if (!isset($_SESSION)) {
	session_start();
}
//connect to db
$dbhost = "localhost";// this will ususally be 'localhost', but can sometimes differ
$dbname = "alusm";// the name of the database that you are going to use for this project
$dbuser = "root";// the username that you created, or were given, to access your database
$dbpass = "";// the password that you created, or were given, to access your database

// $GLOBALS["mysql_hostname"] = "sql12.freemysqlhosting.net";
// $GLOBALS["mysql_username"] = "sql12340558";
// $GLOBALS["mysql_password"] = "9ETjVU3WS3";
// $GLOBALS["mysql_database"] = "sql12340558";

// $dbhost = "sql12.freemysqlhosting.net";// this will ususally be 'localhost', but can sometimes differ
// $dbname = "sql12340558";// the name of the database that you are going to use for this project
// $dbuser = "sql12340558";// the username that you created, or were given, to access your database
// $dbpass = "9ETjVU3WS3";// the password that you created, or were given, to access your database

$conn      = mysqli_connect($dbhost, $dbuser, $dbpass) or die("MySQL Error with $conn on base.php: " .mysql_error());
$db_select = mysqli_select_db($conn, $dbname) or die("MySQL Error with $db_select on base.php: " .mysql_error());

if (!$db_select) {
	echo "Could not select database";
}

if (!$conn) {
	echo "Could not connect.";
}

?>