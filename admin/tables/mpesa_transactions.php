
<?php
include_once '../config/database.php';
$table = "mpesa_transactions";
$database = new Database();
$conn = $database->getConnection();
	try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // sql to create table
    $sql = "CREATE TABLE IF NOT EXISTS $table (
  `trans_id` varchar(40) NOT NULL ,
  `trans_time` varchar(40) NOT NULL ,
  `amount` varchar(40) NOT NULL ,
  `station_id` varchar(256) NOT NULL,
  `mobile_number` varchar(40) NOT NULL ,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  PRIMARY KEY (`trans_id`), 
  FOREIGN KEY (station_id) REFERENCES stations(station_id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ";

    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Table created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
$conn = null;
?>