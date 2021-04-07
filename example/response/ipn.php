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
$respose = $_POST;

echo print_r($respose);

Log::INFO(json_encode($_REQUEST));

if(!$respose){
    exit('支付失败，无返回结果');
}
//获取备注信息
if(($respose['trade_status'])!='success'){
    exit('支付失败');
}

//往下进行本身系统订单的异步处理



echo 'SUCCESS';