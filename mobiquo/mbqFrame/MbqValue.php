<?php

defined('MBQ_IN_IT') or exit;

/**
 * value class
 * 
 * @since  2012-7-2
 * @author Wu ZeTao <578014287@qq.com>
 */
Class MbqValue {
    
    private $hasSetOriValue;   /* has set oriValue flag */
    private $hasSetAppDisplayValue;   /* has set appDisplayValue flag */
    private $hasSetTmlDisplayValue;   /* has set tmlDisplayValue flag */
    private $hasSetTmlDisplayValueNoHtml;   /* has set tmlDisplayValueNoHtml flag */
    /* you should set values by set method!!!because the set method will do more work on flag instead of only assignment. */
    public $oriValue;   /* original value saved in application */
    public $appDisplayValue;    /* handled internally by application and displayed in application */
    public $tmlDisplayValue;    /* handled by tapatalk and displayed in terminal application,mobile etc.return_html = true. */
    public $tmlDisplayValueNoHtml;    /* handled by tapatalk and displayed in terminal application,mobile etc.return_html = false. */
    
    /**
     * @param  Array  $p  params for create the object.
     * $p['oriValue']
     * $p['appDisplayValue']
     * $p['tmlDisplayValue']
     * $p['tmlDisplayValueNoHtml']
     */
    public function __construct($p = NULL) {
        if (is_array($p) && $p) {
            if (isset($p['oriValue'])) $this->setOriValue($p['oriValue']);
            if (isset($p['appDisplayValue'])) $this->setOriValue($p['appDisplayValue']);
            if (isset($p['tmlDisplayValue'])) $this->setOriValue($p['tmlDisplayValue']);
            if (isset($p['tmlDisplayValueNoHtml'])) $this->setOriValue($p['tmlDisplayValueNoHtml']);
        }
    }
    
    /**
     * judge the oriValue has been set
     *
     * @return  Boolean
     */
    public function hasSetOriValue() {
        return $this->hasSetOriValue;
    }
    
    /**
     * judge the appDisplayValue has been set
     *
     * @return  Boolean
     */
    public function hasSetAppDisplayValue() {
        return $this->hasSetAppDisplayValue;
    }
    
    /**
     * judge the tmlDisplayValue has been set
     *
     * @return  Boolean
     */
    public function hasSetTmlDisplayValue() {
        return $this->hasSetTmlDisplayValue;
    }
    
    /**
     * judge the tmlDisplayValueNoHtml has been set
     *
     * @return  Boolean
     */
    public function hasSetTmlDisplayValueNoHtml() {
        return $this->hasSetTmlDisplayValueNoHtml;
    }
    
    /**
     * set oriValue
     *
     * @param  Mixed  $v
     */
    public function setOriValue($v) {
        $this->oriValue = $v;
        $this->hasSetOriValue = true;
    }
    
    /**
     * set appDisplayValue
     *
     * @param  Mixed  $v
     */
    public function setAppDisplayValue($v) {
        $this->appDisplayValue = $v;
        $this->hasSetAppDisplayValue = true;
    }
    
    /**
     * set tmlDisplayValue
     *
     * @param  Mixed  $v
     */
    public function setTmlDisplayValue($v) {
        $this->tmlDisplayValue = $v;
        $this->hasSetTmlDisplayValue = true;
    }
    
    /**
     * set tmlDisplayValueNoHtml
     *
     * @param  Mixed  $v
     */
    public function setTmlDisplayValueNoHtml($v) {
        $this->tmlDisplayValueNoHtml = $v;
        $this->hasSetTmlDisplayValueNoHtml = true;
    }
  
}

?>