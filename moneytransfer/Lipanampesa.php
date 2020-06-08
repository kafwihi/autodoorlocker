<?php
    require_once("Mpesa.php");
    require_once("include/DBconnect.php");
    $db = new DBconnect();
    $conn = $db->connect();
    $mpesa = new Mpesa();
    $data = json_decode(file_get_contents("php://input"));
    $response = "";

    $businesscode = $data->shortcode;
    $partya = $data->phone;
    $partyb = $businesscode;
    $phone = $partya;
    $desc = $data->desc;
    $amount = $data->amount;
    $response = "";
    $result = $mpesa->stkpush($businesscode,$amount,$partya,$partyb,$phone,$desc);
    $output = json_decode($result);
    $merchantid = $output->MerchantRequestID;
    echo $merchantid;
    $mydate=getdate(date("U"));
    $date = $mydate['mday'].$mydate['month'].$mydate['year'];
    echo $date;
    $query = "Insert into lipanampesa(merchantRequestID,amount,transactionDate,shortcode) values('$merchantid',
    '$amount','$date','$partyb')";
    $result = $conn->query($query);
    if($result){
      $response = "true";
    }           
    else{
      $response = "false";
    }
    echo $response;
        
?>