<?php

/**
 * push base class
 * 
 * @since  2013-7-10
 * @author Wu ZeTao <578014287@qq.com>
 */
Abstract Class TapatalkBasePush {
    
    protected $pushStatus = false; //judged by push flag in get_config and curl_init,allow_url_fopen and push key
    protected $pushKey = '';
    protected $slugData = array();  //default is empty array
    protected $imActive = false;    //judge current user is active user by tapatalk_push_user table
    protected $siteUrl;
    
    //init
    public function __construct() {
    }
    
    /**
     * wrap method invoking from outside.
     * this method should be the only entry from outside for sending push,because other methods maybe have not been implemented,this entry methond can prevent the error occuring
     * if the corresponding method has not been implemented,then will do nothing
     *
     * @params  String  $methodName
     * @params  Array  $p  params should be transmitted to the corresponding method
     * There are only several methods can be called,they should be protected methods:
        doAfterAppLogin()   record user info after user login from app
        sendSubPush()
        sendPmPush()
        sendConvPush()
        sendLikePush()
        sendThankPush()
        sendQuotePush()
        sendTagPush()
        sendNewtopicPush()
     */
    public function callMethod($methodName, $p = NULL) {
        if (method_exists($this, $methodName)) {   //!!!
            if ($p)
                return $this->$methodName($p);
            else
                return $this->$methodName();
        }
    }
    
}

?>