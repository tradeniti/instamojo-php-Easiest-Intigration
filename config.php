<?php
	$email = 'YOUR-EMAIL-ID@gmail.com';                      //To Sent to a notify email whenever a user complete a payment.
    $api_key = 'test_3f27618b856a1a3aaa4d7dfe40c';     //Private API Key (https://www.instamojo.com/integrations).
    $api_secret = 'test_2b9c17bd2886d461b6fe4aef5cd';  //Private Auth Token (https://www.instamojo.com/integrations).
    $api_salt = '79f3764cf9f040c0a841eddfa8794cee';    //Private Salt.
	$webhook_url = 'https://tradeniti.in/insta/webhook.php';  //Your Website Link.
	$redirect_url = 'https://tradeniti.in/insta/success.php'; //Your Website Link.
    $mode = "live"; //You can change it to test for testing purpose.
    if($mode == 'live'){
        $mode = 'www';
    }else{
        $mode = 'test';
    }
    
?>
