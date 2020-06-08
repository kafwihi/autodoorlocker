<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "autolocker";
$tablename = "lockers";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO `lockers` (`locker_id`, `station_id`, `status`, `created_on`) VALUES
( 'L03', 'A001', 'free','2014-05-30 17:34:33')

";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>