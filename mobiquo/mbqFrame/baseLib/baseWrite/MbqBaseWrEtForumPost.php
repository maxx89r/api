<?php

defined('MBQ_IN_IT') or exit;

/**
 * forum post write class
 * 
 * @since  2012-8-21
 * @author Wu ZeTao <578014287@qq.com>
 */
Abstract Class MbqBaseWrEtForumPost extends MbqBaseWr {
    
    public function __construct() {
    }
    
    /**
     * add forum post
     */
    public function addMbqEtForumPost() {
        MbqError::alert('', __METHOD__ . ',line:' . __LINE__ . '.' . MBQ_ERR_INFO_NEED_ACHIEVE_IN_INHERITED_CLASSE);
    }
  
}

?>