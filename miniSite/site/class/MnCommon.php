<?php

/**
 * common functions
 * 
 * @since  2013-8-7
 * @author Wu ZeTao <578014287@qq.com>
 */
Class MnCommon Extends AppDo {

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * call json api
     *
     * @param  Array  $param
     * @return  Mixed
     * $param['get']  means get data
     * $param['post']  means post data
     * @return  String
     */
    public function callApi($param) {
        global $tapatalkPluginApiConfig;
        if (!$param['get']) $param['get'] = array();
        if (!$param['post']) $param['post'] = array();
        foreach ($param['get'] as $k => $v) {
            if ($getUrl) $getUrl .= "&$k=".urlencode($v);
            else $getUrl = "$k=".urlencode($v);
        }
        $apiUrl = $tapatalkPluginApiConfig['url']."?$getUrl";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param['post']);
        if ($_COOKIE) {
            foreach($_COOKIE as $k => $v) {
                if( $cookies) {
                    $cookies .= ";".$k."=".urlencode($v);
                } else {
                    $cookies = $k."=".urlencode($v);
                }
            }
            curl_setopt($ch, CURLOPT_COOKIE, $cookies);
        }
        if ($ip = MainApp::$oCf->getIp()) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('CLIENT-IP:'.$ip, 'X-FORWARDED-FOR:'.$ip));
        }
        $strRet = curl_exec($ch);
        curl_close ($ch);
        return $strRet;
    }
    
    /**
     * judge call api success
     *
     * @param  Mixed  result returned by api
     * @return  Boolean
     */
    public function callApiSuccess($strRet) {
        if ($strRet) {
            $data = json_decode($strRet);
            if ($data !== NULL) {
                if ($data->result === false) {
                    return false;
                } else {
                    return true;
                }
            }
        }
        return false;
    }
    
    /**
     * return api error array,this method only used when call api failed
     */
    public function getApiError($strRet) {
        if ($strRet) {
            return json_decode($strRet);
        } else {
            $arr = array(
                'result' => false,
                'error' => 'Unknown error.Maybe net is too slow.',
                'code' => MBQ_ERR_TOP
            );
            return json_decode(json_encode($arr));
        }
    }
    
    /**
     * return api error string for display,this method only used when call api failed
     */
    public function getApiErrorStr($strRet) {
        $o = $this->getApiError($strRet);
        return "Error info:$o->error,error code:$o->code.";
    }
    
}

?>