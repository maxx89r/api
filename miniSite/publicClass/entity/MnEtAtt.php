<?php

MainApp::$oClk->includeClass('MbqEtAtt');

/**
 * attachment class
 * 
 * @since  2013-8-5
 * @author Wu ZeTao <578014287@qq.com>
 */
Class MnEtAtt extends MbqEtAtt {
    
    public $oMnEtUser; /* user who submit this attachment */
    
    public function __construct() {
        parent::__construct();
        
        $this->oMnEtUser = NULL;
    }
  
}

?>