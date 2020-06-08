<?php
    require_once "include/DBconnect.php";
    class Mpesa{
        public $securitycredentials = 
"dzuW6K64T9m9pr9tNslOJZSRbO4t73T5IUPfum+vuwj2c8afZfbsdqhxpSLj5GFJzDVOm2Jfu96rMgq0o0gTRZzUwJaNJxO3XkHaNVOm/wz7xvzj10tVnNEErlvf/wUry//to6f2i9CNtfFMV50TYaZIjuFhoLbuWSfX12LOpUKrvAEeoIBfQlI2Z23OxEWXl3kepfDUfSUw1oP3Ly3wvgiwVoZu5wRRW4PBRdEZ/Hag9NtL/R4LC3WiguYNs0uYVADTcxE/xINAWq0qMqVxldX9HnwZdXW0+3x5of6/3E76TpiyGELMOqX3hFXKXgVoQ5leh1cIpAk3jEFhDvcNtg==";
     public $baseurl = "https://235b7613818e.ngrok.io/autodoorlocker/";
    public $basecallbackurl = "https://235b7613818e.ngrok.io/autodoorlocker/moneytransfer/callback/";
        protected $db;
        protected $conn;
        public function __construct(){
            $db = new DBconnect();
            $this->conn = $db->connect();
        }
       public function generateToken(){
            $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            $consumerkey = 'wBAUTnuUKuJJ9HtPrPaLdDEHZTOWBvVG';
            $consumersecret = 'kLkvklHmsIg1nu3q';
  //$credentials = base64_encode('GaAly3ocNeD6mJSZKMwUVPXKP1n3fpFC:nGeTvE6Qy6yAOHyz');
            $credentials = base64_encode($consumerkey.':'.$consumersecret);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$credentials)); //setting a custom header
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

            $curl_response = curl_exec($curl);
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $result = json_decode($curl_response);
            return $result;
        }

        public function stkpush($shortcode,$amount,$partya,$partyb,$phone,$desc){
            $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
            $curl = curl_init();
            $token = $this->generateToken();
            //$token = $gettoken->access_token;
            $LipaNaMpesaPasskey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
            $timestamp='20'.date("ymdhis");
            $password=base64_encode($shortcode.$LipaNaMpesaPasskey.$timestamp);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json',
            'Authorization:Bearer ' .$token)); //setting custom header
            $curl_post_data = array(
                //Fill in the request parameters with valid values
                'BusinessShortCode' => $shortcode,
                'Password' => $password,
                'Timestamp' => $timestamp,
                'TransactionType' => 'CustomerPayBillOnline',
                'Amount' => $amount,
                'PartyA' => $partya,
                'PartyB' => $partyb,
                'PhoneNumber' =>$phone,
                'CallBackURL' => $this->baseurl.'Callback.php',
                'AccountReference' => 'Samuel',
                'TransactionDesc' => $desc
            );

            $data_string = json_encode($curl_post_data);

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($curl, CURLOPT_HEADER, false);

            $curl_response = curl_exec($curl);
            $result = json_decode($curl_response);
            // $merchantid = $result->MerchantRequestID;
            // $date = NOW();
            // $query = "Insert into lipanampesa(MerchantRequestID,amount,transactionDate) values($merchantid,
            // $amount,$date)";
            // $result
            return $curl_response;
        }
        //generate account balance
        public function accountBalance($initiator,$partya,$remarks){
            $url = 'https://sandbox.safaricom.co.ke/mpesa/accountbalance/v1/query';
            $gettoken = $this->generateToken();
            $token = $gettoken->access_token;

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$token)); //setting custom header

            $curl_post_data = array(
              //Fill in the request parameters with valid values
              'Initiator' => $initiator,
              'SecurityCredential' => $this->securitycredentials,
              'CommandID' => 'AccountBalance',
              'PartyA' => $partya,
              'IdentifierType' => '4',
              'Remarks' => $remarks,
              'QueueTimeOutURL' => $this->baseurl.'Balance.php',
              'ResultURL' => $this->baseurl.'Balance.php'
            );

            $data_string = json_encode($curl_post_data);

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

            $curl_response = curl_exec($curl);
            print_r($curl_response);

            return $curl_response;
        }
        //perform reversal
        public function reversal(){

        }
		
		 public function registerurl($shortcode){
            $url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';
            $gettoken = $this->generateToken();
            $token = $gettoken->access_token;

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$token)); //setting custom header

            $curl_post_data = array(
                //Fill in the request parameters with valid values
                'ShortCode' => $shortcode,
                'ResponseType' => 'complete',
                'ConfirmationURL' => $this->basecallbackurl.'C2bcallback.php',
                'ValidationURL' => $this->basecallbackurl.'C2bcallback.php'
            );

            $data_string = json_encode($curl_post_data);

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

            $curl_response = curl_exec($curl);
            print_r($curl_response);

            return $curl_response;
        }



/**
     * Use this function to process the C2B Validation request callback
     * @return string
     */
    public static function processC2BRequestValidation(){
        $callbackJSONData=file_get_contents('php://input');
        $callbackData=json_decode($callbackJSONData);
        $transactionType=$callbackData->TransactionType;
        $transID=$callbackData->TransID;
        $transTime=$callbackData->TransTime;
        $transAmount=$callbackData->TransAmount;
        $businessShortCode=$callbackData->BusinessShortCode;
        $billRefNumber=$callbackData->BillRefNumber;
        $invoiceNumber=$callbackData->InvoiceNumber;
        $orgAccountBalance=$callbackData->OrgAccountBalance;
        $thirdPartyTransID=$callbackData->ThirdPartyTransID;
        $MSISDN=$callbackData->MSISDN;
        $firstName=$callbackData->FirstName;
        $middleName=$callbackData->MiddleName;
        $lastName=$callbackData->LastName;

        $result=[
            $transTime=>$transTime,
            $transAmount=>$transAmount,
            $businessShortCode=>$businessShortCode,
            $billRefNumber=>$billRefNumber,
            $invoiceNumber=>$invoiceNumber,
            $orgAccountBalance=>$orgAccountBalance,
            $thirdPartyTransID=>$thirdPartyTransID,
            $MSISDN=>$MSISDN,
            $firstName=>$firstName,
            $lastName=>$lastName,
            $middleName=>$middleName,
            $transID=>$transID,
            $transactionType=>$transactionType

        ];

        return json_encode($result);

    }
    }

?>