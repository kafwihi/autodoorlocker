<?php
 //defined('BASEPATH') OR exit('No direct script access allowed');
   
//set_include_path('/include/DBconnect.php');
   //require (APPPATH . '/include/DBconnect.php');
    
include_once '../config/database.php';
 include_once('../models/functions.php');
    $db = new Database();
$conn = $db->getConnection();
    
    $aids = new General_Aids($db);
	
$tablename = "operations";
//$password = $aids->password_generate('1234567890',4);

$password = $aids->generatePIN(4);
$now = new DateTime();

$lockeravailable = $aids->auto_locker_allocation($conn);
try {
     // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO operations
	(`locker_id`,`trans_id`,`password`, `date_on`,`time_in`,`time_out`) VALUES
( '$lockeravailable','MXEDE21W',$password, CURDATE(),'$now', '19:34:33')

";
    // use exec() because no results are returned
	if($lockeravailable!=null){
    $conn->exec($sql);
    echo "New record created successfully";//send the locker id and password to the customer for use
	}
	else
	{
		echo "No free locker found";//respond to the client using an sms
	}
    }
catch(PDOException $e)
    {
    echo $sql . "error moshe <br>" . $e->getMessage();
    }

$conn = null;
?>