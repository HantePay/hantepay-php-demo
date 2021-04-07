<?php
require_once '../config.php';
require_once 'HantepayApi.php';

$headers = array(
	"Accept: application/json",
    "Content-Type:application/json"
);

$data = array(
	'merchant_no'   => '1025258896',
    'store_no'      => 'S1000007',
    'sign_type'     => 'MD5',
    'nonce_str'     => $_REQUEST['nonce_str'],
    'time'          => $_REQUEST['time'],
    'out_trade_no'  => $_REQUEST['out_trade_no'],
    'amount'        => $_REQUEST['amount'],
    'rmb_amount'    => $_REQUEST['rmb_amount'],
    'currency'      => 'USD',
    'payment_method'=> $_REQUEST['payment_method'],
    'terminal'      => $_REQUEST['terminal'],
    'notify_url'    => $_REQUEST['notify_url'],
    'callback_url'  => $_REQUEST['callback_url'],
    'body'          => $_REQUEST['body'],
    'note'          => $_REQUEST['note']
);

$token = TOKEN;
$hantepayapi = new HantepayApi($data,$token);
$signature = $hantepayapi->getSignature();
$data['signature'] = $signature;

$securePayURL = API_URL . "/v2/gateway/securepay";

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_URL, $securePayURL);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
$response = curl_exec($ch);
if (!$response) {
    var_dump($securePayURL);
    var_dump($data);
	die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
}
curl_close($ch);
$result = json_decode($response);
if($result->return_code == "ok" && $result->result_code == "SUCCESS"){
    $url = $result->data->pay_url;
    header("Location: $url");
}else{
    echo $response;
}










