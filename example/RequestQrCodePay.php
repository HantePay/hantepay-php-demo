<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" /> 
    <title>express pay</title>
</head>
<?php
/******
 *
 *  File:          RequestQrCodePay.php
 *  Description:
 *
 ******/

require_once '../config.php';
require_once 'HantepayApi.php';

$headers = array(
    "Accept: application/json",
    "Content-Type:application/json"
);

function printf_info($data)
{
    foreach($data as $key=>$value){
        if (is_array($value)){
            foreach($value as $key1=>$value1){
                echo "<font color='#f00;'>$key1</font> : $value1 <br/>";
            }
        }else{
            echo "<font color='#f00;'>$key</font> : $value <br/>";
        }
    }
}


$data = array(
        'merchant_no'     => $_REQUEST['merchant_no'],
        'store_no'        => $_REQUEST['store_no'],
        'sign_type'       => $_REQUEST['sign_type'],
        'nonce_str'       => $_REQUEST['nonce_str'],
        'time'            => $_REQUEST['time'],
        'out_trade_no'    => $_REQUEST['out_trade_no'],
        'amount'          => $_REQUEST['amount'],
        'currency'        => $_REQUEST['currency'],
        'payment_method'  => $_REQUEST['payment_method'],
        'notify_url'      => $_REQUEST['notify_url'],
        'body'            => $_REQUEST['body'],
        'note'            => $_REQUEST['note']
);
$token = TOKEN;
$hantepayapi = new HantepayApi($data,$token);
$signature = $hantepayapi->getSignature();
$data['signature'] = $signature;

$expressPayURL =  API_URL . "/v2/gateway/qrcode";

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_URL, $expressPayURL);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if (!$response) {
	die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
}
if ($httpCode != 200) {
	//has error
	echo $response;
} else {
    if (json_decode($response, true)) {
        printf_info(json_decode($response, true));
    } else {
        echo $response;
    }
}
curl_close($ch);

