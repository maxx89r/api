<?php

MainApp::$oClk->includeClass('MbqEtUser');

/**
 * user class
 * 
 * @since  2013-8-5
 * @author Wu ZeTao <578014287@qq.com>
 */
Class MnEtUser extends MbqEtUser {
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * normally,we return $this->loginName if $this->userName is invalid.
     *
     * @return  String
     */
    public function getDisplayName() {
        return $this->userName->oriValue;
    }
  
}

?>