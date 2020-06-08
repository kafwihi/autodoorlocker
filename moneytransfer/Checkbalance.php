<?php
  require_once("Mpesa.php");
  $mpesa = new Mpesa();
  if(isset($_POST['initiator'])&&isset($_POST['partya'])&&isset($_POST['remarks'])){
    $initiator = $_POST['initiator'];
    $partya = $_POST['partya'];
    $remarks = $_POST['remarks'];
    $result = $mpesa->accountBalance($initiator,$partya,$remarks);
    echo $result;
  }

?>