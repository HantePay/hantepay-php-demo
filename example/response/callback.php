<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" /> 
    <title>IPN</title>
</head>
<?php
require_once '../../config.php';
require_once '../../lib/log.php';
//init log
$logHandler= new CLogFileHandler("../../logs/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);
Log::INFO("begin notify");

function printf_info($data)
{
    foreach($data as $key=>$value){
        echo "<font color='#1A237E'>$key</font> : $value <br/>";
    }
}


Log::INFO(json_encode($_REQUEST));

$url = $_SERVER['QUERY_STRING'];

parse_str(urldecode($url),$query_arr);

function sign($query_arr,$token) {
     ksort($query_arr);
        $sign_str = "";
        foreach ($query_arr as $key => $val) {
            if($key == 'signature') {
                continue;
            }
            if($val == null || $val == '' || $val == 'null') {
                continue;
            }
            $sign_str .= sprintf("%s=%s&", $key, $val);
        }
    $sign_str = $sign_str.$token;
    return md5($sign_str);
}

if($query_arr['signature'] != sign($query_arr, TOKEN)) {
    exit('签名失败');
}

if($query_arr['trade_status'] == 'success') {
    echo " Payment successful.<br/>";
}else{
    echo "unpaid <br/>";
}
