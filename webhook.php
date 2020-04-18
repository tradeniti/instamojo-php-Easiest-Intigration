<?php
/*
Basic PHP script to handle Instamojo RAP webhook.
*/
include 'config.php';
$data = $_POST;
$mac_provided = $data['mac'];  // Get the MAC from the POST data
unset($data['mac']);  // Remove the MAC key from the data.
$ver = explode('.', phpversion());
$major = (int) $ver[0];
$minor = (int) $ver[1];
if($major >= 5 and $minor >= 4){
ksort($data, SORT_STRING | SORT_FLAG_CASE);
}
else{
uksort($data, 'strcasecmp');
}
// You can get the 'salt' from Instamojo's developers page(make sure to log in first): https://www.instamojo.com/developers
// Pass the 'salt' without <>
$mac_calculated = hash_hmac("sha1", implode("|", $data), "79f3764cf9f040c0a841eddfa8794cee");
if($mac_provided == $mac_calculated){
if($data['status'] == "Credit"){
$to = "jitendrasahu17996@gmail.com";
$subject = 'Test Payment Details | ' .$data['buyer_name'].'';
$message = "<h1>Payment Details</h1>";
$message .= "<hr>";
$message .= '<p><b>ID:</b> '.$data['payment_id'].'</p>';
$message .= '<p><b>Amount:</b> '.$data['amount'].'</p>';
$message .= "<hr>";
$message .= '<p><b>Name:</b> '.$data['buyer_name'].'</p>';
$message .= '<p><b>Email:</b> '.$data['buyer'].'</p>';
$message .= '<p><b>Phone:</b> '.$data['buyer_phone'].'</p>';
$message .= "<hr>";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
// send email
mail($to, $subject, $message, $headers);
}
else{
// Payment was unsuccessful, mark it as failed in your database.
// You can acess payment_request_id, purpose etc here.
}
}
else{
echo "MAC mismatch";
}
?>
