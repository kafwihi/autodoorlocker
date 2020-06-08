<?php 


 CURLOPT_URL => "https://www.sms.movesms.co.ke/API/
             
  $postData = array(
                    'action' => 'compose',
                    'username' => $username,
                    'api_key' => $Key,
                    'sender' => $senderId,
                    'to' => $tophonenumber,
                    'message' => $finalmessage,
                    'msgtype' => $msgtype,
                    'dlr' => $dlr,
                );


                $ch = curl_init();
                curl_setopt_array($ch, array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => $postData

                ));

                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

                $output = curl_exec($ch);

                if (curl_errno($ch)) {
                    // echo 'error:' . curl_error($ch);
                    $output = curl_error($ch);
                }

                curl_close($ch);



?>