<?php

namespace App\traits;

trait SendSMS{
    public function SendOtpToNumber($number,$otp){
        $apiKey = urlencode('Nzg0YjU0NTAzMDM1NGQzOTcwNDk2ZDc3Nzg1MzYxNTc=');
	
        // Message details
        $numbers = array("91$number");
        $sender = urlencode("CDHELP");
        $message = rawurlencode("OTP to login to CoachingDetail.com is $otp.");
     
        $numbers = implode(',', $numbers);
     
        // Prepare data for POST request
        // $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
     

        $data = 'apikey=' . $apiKey . '&numbers=' . $numbers . "&sender=" . $sender . "&message=" . $message;
 
        // Send the GET request with cURL
        $ch = curl_init('https://api.textlocal.in/send/?' . $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        // Send the POST request with cURL
        // $ch = curl_init('https://api.textlocal.in/send/');
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // $response = curl_exec($ch);
        // curl_close($ch);
        
        // Process your response here
        return json_decode($response);
    }
}
