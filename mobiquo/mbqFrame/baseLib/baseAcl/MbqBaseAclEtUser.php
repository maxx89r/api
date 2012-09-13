<?php

defined('MBQ_IN_IT') or exit;

/**
 * user acl class
 * 
 * @since  2012-9-13
 * @author Wu ZeTao <578014287@qq.com>
 */
Abstract Class MbqBaseAclEtUser extends MbqBaseAcl {
    
    public function __construct() {
    }
    
    /**
     * judge can get online users
     *
     * @return  Boolean
     */
    public function canAclGetOnlineUsers() {
        MbqError::alert('', __METHOD__ . ',line:' . __LINE__ . '.' . MBQ_ERR_INFO_NEED_ACHIEVE_IN_INHERITED_CLASSE);
    }
  
}

?>