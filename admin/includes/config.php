<?php 
// DB credentials.
define('DB_HOST','localhost'); // Database host
define('DB_USER','root'); // Database username
define('DB_PASS',''); // Database password
define('DB_NAME','mylib'); // Database name
// Establish database connection.
try
{
    $dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")); // Establish PDO connection
}
catch (PDOException $e)
{
    exit("Error: " . $e->getMessage()); // Display error message if connection fails
}
?>