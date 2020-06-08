<?php
    $postData = file_get_contents('php://input');
    //perform your processing here, e.g. log to file....
   // require_once("include/DBconnect.php");
   // $db = new DBconnect();
    //$conn = $db->connect();
    $file = fopen("validation.txt", "w")  or die("Unable to open file!"); //url fopen should be allowed for this to occur
    if(fwrite($file, $postData) === FALSE)
    {
        fwrite("Error: no data written");
    }

    //fwrite("\r\n","");
    fclose($file);

   // $callbackData=json_decode($postData);
    //$resultCode=$callbackData->Body->stkCallback->ResultCode;
    //$resultDesc=$callbackData->Body->stkCallback->ResultDesc;
    
    echo json_encode('{"ResponseCode":"0","ResultDesc":"Confirmation received successfully"}');
?>