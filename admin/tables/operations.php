
<?php
include_once '../config/database.php';
$table = "operations";
$database = new Database();
$conn = $database->getConnection();	
try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // sql to create table
    $sql = "CREATE TABLE IF NOT EXISTS $table (
  `oper_id` int(12) NOT NULL AUTO_INCREMENT,
  `locker_id` varchar(50) NOT NULL,
  `trans_id` varchar(50) NOT NULL, 
  `password` varchar(4) NOT NULL,  
  `date_on` text ,
  `time_in` text ,
  `time_out` text ,
  PRIMARY KEY (`oper_id`), 
  FOREIGN KEY (trans_id) REFERENCES mpesa_transactions(trans_id)
  , FOREIGN KEY (locker_id) REFERENCES lockers(locker_id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ";
     $conn->exec($sql);
    echo "Table created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
$conn = null;

?>