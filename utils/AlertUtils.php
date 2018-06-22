<?php

namespace app\utils;

class AlertUtils {
    const MAIL_URL  = "http://momentodeck.com/Mail_API/send_email_hf.php";
    const SEND_ALERT_URL  = "http://news.momentodeck.com/GCM_KCB/send_gcm_alert.php";
    const SEND_SMS_URL  = "http://momentodeck.com/bank/index.php/Users/SendSMS";
    const SEND_SMS_API_USERNAME  = "!2345sdgdfshAS";
    const SEND_SMS_API_PASSWORD  = "!2345sdgdfshAS";

    /**
     * Send email to a recipient
     * @param string $email
     * @param string $subject
     * @param string $message
     */
    public static function invokeSendMailAPI($email, $subject, $message) 
    {
        $url = self::MAIL_URL;

        $fields = array(
             'userid' => "!sdj6252!@2783dgdh4254466wee@737",
             'userpass' => "!783dgdfccad2425626svdsasdh4254466wee",
             'emailAddress' => $email,
             'subject' => $subject,
             'body' => $message,
        );

        $fields_string = "";

        foreach ($fields as $key => $value) {
            $fields_string.= $key . '=' . $value . '&';
        }
        rtrim($fields_string, '&');

        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        //  curl_setopt($ch, CURLOPT_PROXY, "172.17.70.206:8020");
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute post
        $resultJson = curl_exec($ch);

        // Close connection
        curl_close($ch);

        return $resultJson;
    }
    
    /**
     * Send GSM alert
     * @param string $title
     * @param string $msg
     * @param string $imageurl
     * @param string $customerids
     */
    public static function invokeSendAlertAPI($title, $msg, $imageurl, $customerids) 
    {
        $url = self::SEND_ALERT_URL;
        
        $fields = array(
            'userid' => "!sdj6252!@2783dgdh4254466wee@737",
            'userpass' => "!783dgdfccad2425626svdsasdh4254466wee",
            'title' => $title,
            'msg' => $msg,
            'image_url' => $imageurl,
        );
        
        if($customerids != null && $customerids !== ""){
            $fields['customerids'] = $customerids;
        }

        $fields_string = "";

        foreach ($fields as $key => $value) {
            $fields_string.= $key . '=' . $value . '&';
        }
        rtrim($fields_string, '&');

        // Open connection
        $ch = curl_init();


        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_PROXY, "172.17.70.206:8020");
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute post
        $resultJson = curl_exec($ch);
        // if ($result === FALSE) {
            // die('Curl failed: ' . curl_error($ch));
        // }

        // Close connection
        curl_close($ch);

        return $resultJson;
    }

    /**
     * Send SMS
     * @param string $phoneNumber
     * @param string $message
     */
    public static function sendSMS($phoneNumber, $message) 
    {
        $sendSMSurl = self::SEND_SMS_URL;
        $apiUsername = self::SEND_SMS_API_USERNAME;
        $apiPassword = self::SEND_SMS_API_PASSWORD;

	    $message = urlencode($message);
        $phoneNumber = "+".$phoneNumber; 
        
        $queryString = "action=sendmessage&username=$apiUsername&password=$apiPassword&recipient=$phoneNumber&messagetype=SMS:TEXT&messagedata=$message";

        $url = $sendSMSurl . "?" . $queryString;
        $fields = array(
            'APPID' => "$apiUsername",
            'PASSWD' => "$apiPassword",
            'msisdn' => "$phoneNumber",
            'message' => "$message",
        );

        $fields_string = "";

        foreach ($fields as $key => $value) {
            $fields_string.= $key . '=' . $value . '&';
        }
        rtrim($fields_string, '&');

        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, count($fields));

        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        // Execute post
        $result = curl_exec($ch);

        if($result != null and trim($result) === "accepted for delivery"){
                $resp = array(
                    'STATUS' => 1,
                    'STATUS_MESSAGE' => "SUCCCESS"
                );

                $result = json_encode($resp);
        }else{
            $error_response = array(
                'STATUS' => 4,
                'STATUS_MESSAGE' => curl_error($ch)
            );

            $result = json_encode($error_response);
        }
        // Close connection
        curl_close($ch);
        return $result;
    }
}
