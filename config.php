<?php
/**
 * Merchant config file
 */
ini_set('date.timezone','UTC');

$server = $_SERVER['SERVER_NAME'];
$uri = 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'.$server;
//set demo php path
//You can view your bearer token in the TMS by logging in and going to Settings -> Certificate -> View API Token.
define('TOKEN', '123456');

define("API_URL", "https://gateway.hantepay.com");//for test environment

define("IPN_URL", "http://website.com/ipn");//your IPN url, Notice: IPN Url can not be localhost
define("CALLBACK_URL", "http://website.com/callback");//your callback url

function getRandomString($len, $chars=null)
{
    if (is_null($chars)){
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    }
    mt_srand(10000000*(double)microtime());
    for ($i = 0, $str = '', $lc = strlen($chars)-1; $i < $len; $i++){
        $str .= $chars[mt_rand(0, $lc)];
    }
    return $str;
}
