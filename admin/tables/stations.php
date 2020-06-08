
<?php
include_once '../config/database.php';
$table = "stations";
$database = new Database();
$conn = $database->getConnection();	
try {
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // sql to create table
    $sql = "CREATE TABLE IF NOT EXISTS $table (
  `station_id` varchar(12) NOT NULL ,
  `station` varchar(50) NOT NULL,
  `created_on` text NOT NULL,
  PRIMARY KEY (`station_id`)
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