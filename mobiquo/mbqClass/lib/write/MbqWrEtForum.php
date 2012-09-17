<?php

defined('MBQ_IN_IT') or exit;

MbqMain::$oClk->includeClass('MbqBaseWrEtForum');

/**
 * forum write class
 * 
 * @since  2012-9-14
 * @author Wu ZeTao <578014287@qq.com>
 */
Class MbqWrEtForum extends MbqBaseWrEtForum {
    
    public function __construct() {
    }
    
    /**
     * subscribe forum
     *
     * @param  Mixed  $var($oMbqEtForum or $objsMbqEtForum)
     */
    public function subscribeForum(&$var) {
        if (is_array($var)) {
            MbqError::alert('', __METHOD__ . ',line:' . __LINE__ . '.' . MBQ_ERR_INFO_NOT_ACHIEVE);
        } else {
            if (!$var->mbqBind['oKunenaForumCategory']->subscribe(1)) {
                MbqError::alert('', "Subscribe forum fail!", '', MBQ_ERR_APP);
            }
        }
    }
    
    /**
     * unsubscribe forum
     *
     * @param  Mixed  $var($oMbqEtForum or $objsMbqEtForum)
     */
    public function unsubscribeForum(&$var) {
        if (is_array($var)) {
            MbqError::alert('', __METHOD__ . ',line:' . __LINE__ . '.' . MBQ_ERR_INFO_NOT_ACHIEVE);
        } else {
            if (!$var->mbqBind['oKunenaForumCategory']->subscribe(0)) {
                MbqError::alert('', "Unsubscribe forum fail!", '', MBQ_ERR_APP);
            }
        }
    }
  
}

?>