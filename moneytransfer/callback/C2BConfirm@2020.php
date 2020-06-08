<?php
    $postData = file_get_contents('php://input');
    //perform your processing here, e.g. log to file....
    require_once("include/DBconnect.php");
    $db = new DBconnect();
    $conn = $db->connect();
    $file = fopen("callbacklog.txt", "w"); //url fopen should be allowed for this to occur
    if(fwrite($file, $postData) === FALSE)
    {
        fwrite("Error: no data written");
    }

   // fwrite("\r\n");
    fclose($file);
    echo json_encode('{"ResponseCode":"0","ResultDesc":"Confirmation received successfully"}');
?>