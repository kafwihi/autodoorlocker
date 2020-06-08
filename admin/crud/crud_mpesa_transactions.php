<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "autolocker";
$tablename = "mpesa_transactions";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO `mpesa_transactions`
	(`trans_id`, `trans_time`,`amount`,`station_id`, `mobile_number`, `fname`,`lname`) VALUES
( 'MXEDE21W', '2014-05-30 17:34:33','10', 'A0011', '0711968960','mOSHE','KAFWIHI')

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