<?php

MainApp::$oClk->includeClass('MbqEtForum');

/**
 * forum class
 * 
 * @since  2013-8-5
 * @author Wu ZeTao <578014287@qq.com>
 */
Class MnEtForum extends MbqEtForum {
    
    public $oParentMnEtForum;  /* parent forum */
    public $objsSubMnEtForum;  /* sub forums */
    
    public function __construct() {
        parent::__construct();
        
        $this->oParentMnEtForum = NULL;
        $this->objsSubMnEtForum = array();
    }
  
}

?>