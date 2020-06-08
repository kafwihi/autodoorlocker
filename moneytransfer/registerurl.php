<?php
    require_once("Mpesa.php");
    require_once("include/DBconnect.php");
    $db = new DBconnect();
    $conn = $db->connect();
    $mpesa = new Mpesa();
    $data = json_decode(file_get_contents("php://input"));
    $response = "";


 $url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';
            $gettoken = $mpesa->generateToken();
            $token = $gettoken->access_token;
echo "toen here "; echo $token;

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$token)); //setting custom header

            $curl_post_data = array(
                //Fill in the request parameters with valid values
                //'ShortCode' => $shortcode,
				'ShortCode' => '600142',
                'ResponseType' => 'complete',
                'ConfirmationURL' => $mpesa->basecallbackurl.'C2BConfirm@2020.php',
                'ValidationURL' => $mpesa->basecallbackurl.'C2BValidation1.php'
            );

            $data_string = json_encode($curl_post_data);

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

            $curl_response = curl_exec($curl);
            print_r($curl_response);

            return $curl_response;
        
          
?>