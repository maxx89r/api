<?php

defined('MBQ_IN_IT') or exit;

/**
 * input/output class
 * 
 * @since  2012-7-8
 * @author Wu ZeTao <578014287@qq.com>
 */
Class MbqIo extends MbqBaseIo {
    
    protected $oHandle;    // real io data handle
    
    public function __construct() {
        parent::__construct();
        
        // identify the protocol
        $this->init();
        
    }
    
    /**
     * Get request protocol based on Content-Type
     *
     * @return string default as xmlrpc
     */
    protected function init() {
        $contentType = MbqMain::$oMbqCm->getRequestHeader('Content-Type');
        switch ($contentType) {
            case 'text/xml':
                $protocol = 'xmlrpc';
                break;
            case 'application/json':
                $protocol = 'json';
                break;
            default:
                $protocol = 'xmlrpc';
        }
        $ioHandleClass = 'MbqIoHandle'.ucfirst($protocol);
        $this->protocol = $protocol;
        $this->oHandle = MbqMain::$oClk->newObj($ioHandleClass);
        $this->cmd = $this->oHandle->getCmd();
        $this->input = $this->oHandle->getInput();
    }
    
    /**
     * intput data
     */
    public function input() {
    }
    
    /**
     * output data
     */
    public function output() {
        $this->oHandle->output(MbqMain::$data);
    }
    
    public function alert($message, $result = false) {
        $this->oHandle->alert($message, $result);
    }
}

?>