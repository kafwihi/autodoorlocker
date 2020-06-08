<?php

    // database connection and table name
include_once '../config/database.php';

   
   

class General_Aids{
	public $table = "lockers";
    // object properties
    public $sid;
    public $station;
    public $created;

 protected $db;
        protected $conn;
        public function __construct(){
            $db = new Database();
            $this->conn = $db->getConnection();
        }

public function generatePIN($digits){
    $i = 0; //counter
    $pin = ""; //our default pin is blank.
    while($i < $digits){
        $pin .= mt_rand(0, 9);
        $i++;
    }
    return $pin;
}
 
/*this function searches for available locker or locker not in use and assigns it to the customer*/
public function auto_locker_allocation($conn){
   $free_locker = null;
  $sql = "SELECT locker_id FROM lockers WHERE status = 'free'";
//$result = $conn->query($sql);


    if(($conn->query($sql))!=false){
	
$free_locker = ($conn->query($sql))->fetchColumn(0);
echo $free_locker;
	}
   
    return $free_locker;
}
 

}
?>