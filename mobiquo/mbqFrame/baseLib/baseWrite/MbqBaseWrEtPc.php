<?php

defined('MBQ_IN_IT') or exit;

/**
 * private conversation write class
 * 
 * @since  2012-11-4
 * @author Wu ZeTao <578014287@qq.com>
 */
Abstract Class MbqBaseWrEtPc extends MbqBaseWr {
    
    public function __construct() {
    }
    
    /**
     * mark private conversation read
     *
     * @return  Mixed
     */
    public function markPcRead() {
        MbqError::alert('', __METHOD__ . ',line:' . __LINE__ . '.' . MBQ_ERR_INFO_NEED_ACHIEVE_IN_INHERITED_CLASSE);
    }
  
}

?>