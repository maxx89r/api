<?php

defined('MBQ_IN_IT') or exit;

/**
 * forum action
 * 
 * @since  2013-5-11
 * @author Wu ZeTao <578014287@qq.com>
 */
Abstract Class MbqBaseActForum extends MbqBaseAct {
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * action implement
     */
    protected function actionImplement() {
        if (!MbqMain::$oMbqConfig->moduleIsEnable('forum')) {
            MbqError::alert('', "Not support module forum!", '', MBQ_ERR_NOT_SUPPORT);
        }
        $forumId = MbqMain::$input['get']['fid'];
        $content = MbqMain::$input['get']['content'] ? MbqMain::$input['get']['content'] : 'both';
        $page = (int) MbqMain::$input['get']['page'];
        $perpage = (int) MbqMain::$input['get']['perpage'];
        $type = MbqMain::$input['get']['type'] ? MbqMain::$input['get']['type'] : 'normal';
        $prefix = MbqMain::$input['get']['prefix'];
        $oMbqDataPage = MbqMain::$oClk->newObj('MbqDataPage');
        $oMbqDataPage->initByPageAndPerPage($page, $perpage);
        $oMbqRdEtForum = MbqMain::$oClk->newObj('MbqRdEtForum');
        $objsMbqEtForum = $oMbqRdEtForum->getObjsMbqEtForum(array($forumId), array('case' => 'byForumIds'));
        if ($objsMbqEtForum && ($oMbqEtForum = $objsMbqEtForum[0])) {
            if ($content == 'sub' || $content == 'both') {
                MbqError::alert('', "Not support content type $content!", '', MBQ_ERR_APP);
            } elseif ($content == 'topic') {
                $oMbqAclEtForumTopic = MbqMain::$oClk->newObj('MbqAclEtForumTopic');
                if ($oMbqAclEtForumTopic->canAclGetTopic($oMbqEtForum)) {    //acl judge
                    switch ($type) {
                        case 'sticky':     /* returns sticky topics. */
                        $oMbqRdEtForumTopic = MbqMain::$oClk->newObj('MbqRdEtForumTopic');
                        $oMbqDataPage = $oMbqRdEtForumTopic->getObjsMbqEtForumTopic($oMbqEtForum, array('case' => 'byForum', 'oMbqDataPage' => $oMbqDataPage, 'top' => true));
                        $this->data['total'] = (int) $oMbqDataPage->totalNum;   //!!! must
                        $this->data['forum'] = $oMbqRdEtForum->returnApiDataForum($oMbqEtForum);
                        $this->data['forums'] = array();
                        $this->data['topics'] = $oMbqRdEtForumTopic->returnApiArrDataForumTopic($oMbqDataPage->datas);
                        break;
                        case 'normal':        /* returns standard topics */
                        $oMbqRdEtForumTopic = MbqMain::$oClk->newObj('MbqRdEtForumTopic');
                        $oMbqDataPage = $oMbqRdEtForumTopic->getObjsMbqEtForumTopic($oMbqEtForum, array('case' => 'byForum', 'oMbqDataPage' => $oMbqDataPage, 'notIncludeTop' => true));
                        $this->data['total'] = (int) $oMbqDataPage->totalNum;   //!!! must
                        $this->data['forum'] = $oMbqRdEtForum->returnApiDataForum($oMbqEtForum);
                        $this->data['forums'] = array();
                        $this->data['topics'] = $oMbqRdEtForumTopic->returnApiArrDataForumTopic($oMbqDataPage->datas);
                        break;
                        case 'all':
                        MbqError::alert('', "Not supported topic type filter:$type.", '', MBQ_ERR_APP);
                        break;
                        default:
                        MbqError::alert('', "Unknown topic type filter:$type.", '', MBQ_ERR_APP);
                        break;
                    }
                } else {
                    MbqError::alert('', '', '', MBQ_ERR_APP);
                }
            } else {
                MbqError::alert('', "Need valid content type!", '', MBQ_ERR_APP);
            }
        } else {
            MbqError::alert('', "Need valid forum id!", '', MBQ_ERR_APP);
        }
    }
  
}

?>