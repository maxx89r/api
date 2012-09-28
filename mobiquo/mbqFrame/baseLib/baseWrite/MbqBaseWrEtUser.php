<?php

defined('MBQ_IN_IT') or exit;

/**
 * user write class
 * 
 * @since  2012-9-28
 * @author Wu ZeTao <578014287@qq.com>
 */
Abstract Class MbqBaseWrEtUser extends MbqBaseWr {
    
    public function __construct() {
    }
    
    /**
     * m_ban_user
     */
    public function mBanUser() {
        MbqError::alert('', __METHOD__ . ',line:' . __LINE__ . '.' . MBQ_ERR_INFO_NEED_ACHIEVE_IN_INHERITED_CLASSE);
    }
  
}

?>