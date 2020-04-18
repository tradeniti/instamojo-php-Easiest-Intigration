<?php
include 'config.php';
if(isset($_POST['submit'])){
$amount = $_POST['amount'];
$name = $_POST['name'];
$number = $_POST['number'];
$email = $_POST['email'];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://'.$mode.'.instamojo.com/api/1.1/payment-requests/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER,
array("X-Api-Key:$api_key",
"X-Auth-Token:$api_secret"));
$payload = Array(
'purpose' => 'Pay Fee',
'amount' => $amount,
'phone' => $number,
'buyer_name' => $name,
'redirect_url' => $redirect_url,
'send_email' => true,
'webhook' => $webhook_url,
'send_sms' => true,
'email' => $email,
'allow_repeated_payments' => false
);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);
curl_close($ch);
$data = json_decode($response, true);
if($data['success'] == 1){
// for on page payment, use this.
//change url for  instamojo.com and paste your test and live dashborad
$payment_id = $data['payment_request']['id'];
echo '<script src="https://js.instamojo.com/v1/checkout.js"></script>
<script>
Instamojo.open("https://'.$mode.'.instamojo.com/@YOUR-ID/'.$payment_id.'");
</script>
';
//and for redirect to payment page, use this and uncomment the header() below.
//header('Location:'.$data['payment_request']['longurl'].'');
}else{
echo '<div class="w3-panel w3-red w3-content">
    <p>Error Try Again Later!</p>
</div>';
}
}
?>
<!DOCTYPE html>
<html>
    <title>How to intregate instamojo payment  </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <body>
        <div class="w3-content w3-border w3-margin-top">
            <h1 class="text-center">intregate Instamojo Payment Gateway in PHP .</h1>
            <div class="container">
                <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info" >
                        <div class="panel-heading">
                            <div class="panel-title">Pay Fee</div>
                        </div>
                        <div style="padding-top:30px" class="panel-body" >
                            <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            <form id="loginform" class="form-horizontal" role="form" method="POST" autocomplete="off">
                                <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="login-username" type="text" class="form-control" name="name"  placeholder="Name" autocomplete="off" required>
                                </div>
                                <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                    <input  type="text" class="form-control" name="number" placeholder="Mobile Number">
                                </div>
                                <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                    <input  type="email" class="form-control" name="email" placeholder="Email " />
                                </div>
                                <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
                                    <input  type="text" class="form-control" name="amount" placeholder="Amount " />
                                </div>
                                <div class="input-group">
                                    <div class="checkbox">
                                        <label>
                                            <input id="login-remember" type="checkbox" name="submit" value="1"> Remember me
                                        </label>
                                    </div>
                                </div>
                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->
                                    <div class="col-sm-12 controls">
                                        <button type="submit" name="submit"class="btn btn-success">Pay Now </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
