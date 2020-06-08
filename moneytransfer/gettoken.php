
	 
	 <?php
	 //https://api.safaricom.co.ke/oauth/v1/generate
  //$url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
  $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
  
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  //$credentials = base64_encode('GaAly3ocNeD6mJSZKMwUVPXKP1n3fpFC:nGeTvE6Qy6yAOHyz');  live data
  
  $credentials = base64_encode('wBAUTnuUKuJJ9HtPrPaLdDEHZTOWBvVG:kLkvklHmsIg1nu3q');
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$credentials)); //setting a custom header
  curl_setopt($curl, CURLOPT_HEADER, true);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  
  $curl_response = curl_exec($curl);
  
			
$result = json_encode($curl_response);
 echo $result;
            return $result;
  ?>
        