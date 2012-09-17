<?php

defined('MBQ_IN_IT') or exit;

/**
 * forum post acl class
 * 
 * @since  2012-8-20
 * @author Wu ZeTao <578014287@qq.com>
 */
Abstract Class MbqBaseAclEtForumPost extends MbqBaseAcl {
    
    public function __construct() {
    }
    
    /**
     * judge can reply post
     *
     * @return  Boolean
     */
    public function canAclReplyPost() {
        MbqError::alert('', __METHOD__ . ',line:' . __LINE__ . '.' . MBQ_ERR_INFO_NEED_ACHIEVE_IN_INHERITED_CLASSE);
    }
    
    /**
     * judge can get quote post
     *
     * @return  Boolean
     */
    public function canAclGetQuotePost() {
        MbqError::alert('', __METHOD__ . ',line:' . __LINE__ . '.' . MBQ_ERR_INFO_NEED_ACHIEVE_IN_INHERITED_CLASSE);
    }
    
    /**
     * judge can search_post
     *
     * @return  Boolean
     */
    public function canAclSearchPost() {
        MbqError::alert('', __METHOD__ . ',line:' . __LINE__ . '.' . MBQ_ERR_INFO_NEED_ACHIEVE_IN_INHERITED_CLASSE);
    }
    
    /**
     * judge can get_raw_post
     *
     * @return  Boolean
     */
    public function canAclGetRawPost() {
        MbqError::alert('', __METHOD__ . ',line:' . __LINE__ . '.' . MBQ_ERR_INFO_NEED_ACHIEVE_IN_INHERITED_CLASSE);
    }
    
    /**
     * judge can save_raw_post
     *
     * @return  Boolean
     */
    public function canAclSaveRawPost() {
        MbqError::alert('', __METHOD__ . ',line:' . __LINE__ . '.' . MBQ_ERR_INFO_NEED_ACHIEVE_IN_INHERITED_CLASSE);
    }
    
    /**
     * judge can get_user_reply_post
     *
     * @return  Boolean
     */
    public function canAclGetUserReplyPost() {
        MbqError::alert('', __METHOD__ . ',line:' . __LINE__ . '.' . MBQ_ERR_INFO_NEED_ACHIEVE_IN_INHERITED_CLASSE);
    }
  
}

?>