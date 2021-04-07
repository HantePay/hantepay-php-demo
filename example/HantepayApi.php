<?php

/**
 */
class HantepayApi {
    public static $signature ;

    public function __construct($data,$token) {
        if(array_key_exists('sign_type',$data)){
            unset($data['sign_type']);
        }
        ksort($data);
        $string=$this->formatUrlParams($data).'&'.$token;
        //MD5加密
        $string=md5($string);
        self::$signature =  strtolower($string);;
    }

    public function getSignature() {
        return self::$signature;
    }

    //格式化参数格式化成url参数
    private function formatUrlParams(array $data) {
        $buff = "";
        foreach ($data as $k => $v) {
            if ($k != "signature" && $v !== "" && !is_array($v)) {
                $buff .= $k . "=" . $v . "&";
            }
        }
        $buff = trim($buff, "&");
        return $buff;
    }


}