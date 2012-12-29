<?php

defined('MBQ_IN_IT') or exit;

/**
 * private message write class
 * 
 * @since  2012-12-29
 * @author Wu ZeTao <578014287@qq.com>
 */
Abstract Class MbqBaseWrEtPm extends MbqBaseWr {
    
    public function __construct() {
    }
    
    /**
     * add private message
     */
    public function addMbqEtPm() {
        MbqError::alert('', __METHOD__ . ',line:' . __LINE__ . '.' . MBQ_ERR_INFO_NEED_ACHIEVE_IN_INHERITED_CLASSE);
    }
  
}

?>