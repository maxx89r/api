<?php

defined('MBQ_IN_IT') or exit;

/**
 * private conversation message read class
 * 
 * @since  2012-11-4
 * @author Wu ZeTao <578014287@qq.com>
 */
Abstract Class MbqBaseRdEtPcMsg extends MbqBaseRd {
    
    public function __construct() {
    }
    
    /**
     * return private conversation message api data
     *
     * @param  Object  $oMbqEtPcMsg
     * @return  Array
     */
    public function returnApiDataPcMsg($oMbqEtPcMsg) {
        $data = array();
        if ($oMbqEtPcMsg->msgId->hasSetOriValue()) {
            $data['msg_id'] = (string) $oMbqEtPcMsg->msgId->oriValue;
        }
        if ($oMbqEtPcMsg->msgContent->hasSetOriValue()) {
            $data['msg_content'] = (string) $oMbqEtPcMsg->msgContent->oriValue;
        }
        if ($oMbqEtPcMsg->msgAuthorId->hasSetOriValue()) {
            $data['msg_author_id'] = (string) $oMbqEtPcMsg->msgAuthorId->oriValue;
        }
        if ($oMbqEtPcMsg->isUnread->hasSetOriValue()) {
            $data['is_unread'] = (boolean) $oMbqEtPcMsg->isUnread->oriValue;
        }
        if ($oMbqEtPcMsg->oAuthorMbqEtUser && $oMbqEtPcMsg->oAuthorMbqEtUser->isOnline->hasSetOriValue()) {
            $data['is_online'] = (boolean) $oMbqEtPcMsg->oAuthorMbqEtUser->isOnline->oriValue;
        }
        if ($oMbqEtPcMsg->hasLeft->hasSetOriValue()) {
            $data['has_left'] = (boolean) $oMbqEtPcMsg->hasLeft->oriValue;
        }
        if ($oMbqEtPcMsg->postTime->hasSetOriValue()) {
            $data['post_time'] = (string) MbqMain::$oMbqCm->datetimeIso8601Encode($oMbqEtPcMsg->postTime->oriValue);
        }
        if ($oMbqEtPcMsg->newPost->hasSetOriValue()) {
            $data['new_post'] = (boolean) $oMbqEtPcMsg->newPost->oriValue;
        }
        return $data;
    }
    
    /**
     * return private conversation message array api data
     *
     * @param  Array  $objsMbqEtPcMsg
     * @return  Array
     */
    public function returnApiArrDataPcMsg($objsMbqEtPcMsg) {
        $data = array();
        foreach ($objsMbqEtPcMsg as $oMbqEtPcMsg) {
            $data[] = $this->returnApiDataPcMsg($oMbqEtPcMsg);
        }
        return $data;
    }
    
    /**
     * get private conversation message objs
     *
     * @return  Mixed
     */
    public function getObjsMbqEtPcMsg() {
        MbqError::alert('', __METHOD__ . ',line:' . __LINE__ . '.' . MBQ_ERR_INFO_NEED_ACHIEVE_IN_INHERITED_CLASSE);
    }
    
    /**
     * init one private conversation message by condition
     *
     * @return  Mixed
     */
    public function initOMbqEtPcMsg() {
        MbqError::alert('', __METHOD__ . ',line:' . __LINE__ . '.' . MBQ_ERR_INFO_NEED_ACHIEVE_IN_INHERITED_CLASSE);
    }
  
}

?>