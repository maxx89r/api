<?php
/**
 * MnEtForumPost init class
 * 
 * @since  2013-8-8
 * @author Wu ZeTao <578014287@qq.com>
 */
Class MnEtForumPostInit Extends AppDo {

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * init MnEtForumPost object by record
     *
     * @param  Object  $recordUser
     */
    public function initMnEtForumPostByRecord($recordForumPost) {
        $oMnEtForumPost = MainApp::$oClk->newObj('MnEtForumPost');
        $oMnEtUserInit = MainApp::$oClk->newObj('MnEtUserInit');
        $oMnEtAttInit = MainApp::$oClk->newObj('MnEtAttInit');
        if (property_exists($recordForumPost, 'id')) {
            $oMnEtForumPost->postId->setOriValue($recordForumPost->id);
        }
        if (property_exists($recordForumPost, 'time')) {
            $oMnEtForumPost->postTime->setOriValue($recordForumPost->time);
        }
        if (property_exists($recordForumPost, 'author')) {
            $oMnEtForumPost->oAuthorMnEtUser = $oMnEtUserInit->initMnEtUserByRecord($recordForumPost->author);
        }
        if (property_exists($recordForumPost, 'content')) {
            $oMnEtForumPost->postContent->setTmlDisplayValue($recordForumPost->content);    //!!!
            $oMnEtForumPost->postContent->setMnDisplayValue($this->makeMnDisplayValue($recordForumPost->content));    //!!!
        }
        if (property_exists($recordForumPost, 'smiley_off')) {
            $oMnEtForumPost->allowSmilies->setOriValue(!$recordForumPost->smiley_off);      //!!!
        }
        if (property_exists($recordForumPost, 'preview')) {
            $oMnEtForumPost->shortContent->setOriValue($recordForumPost->preview);
        }
        if (property_exists($recordForumPost, 'attachs')) {
            $oMnEtForumPost->objsNotInContentMbqEtAtt = $oMnEtAttInit->initObjsMnEtAttByRecords($recordForumPost->attachs);
        }
        if (property_exists($recordForumPost, 'status') && $recordForumPost->status) {
            if (property_exists($recordForumPost->status, 'is_pending')) {
                $oMnEtForumPost->state->setOriValue((int) $recordForumPost->status->is_pending);    //!!!
            }
            if (property_exists($recordForumPost->status, 'is_deleted')) {
                $oMnEtForumPost->isDeleted->setOriValue($recordForumPost->status->is_deleted);
            }
            if (property_exists($recordForumPost->status, 'is_liked')) {
                $oMnEtForumPost->isLiked->setOriValue($recordForumPost->status->is_liked);
            }
            if (property_exists($recordForumPost->status, 'is_thanked')) {
                $oMnEtForumPost->isThanked->setOriValue($recordForumPost->status->is_thanked);
            }
        }
        if (property_exists($recordForumPost, 'permission') && $recordForumPost->permission) {
            if (property_exists($recordForumPost->permission, 'can_edit')) {
                $oMnEtForumPost->canEdit->setOriValue($recordForumPost->permission->can_edit);
            }
            if (property_exists($recordForumPost->permission, 'can_approve')) {
                $oMnEtForumPost->canApprove->setOriValue($recordForumPost->permission->can_approve);
            }
            if (property_exists($recordForumPost->permission, 'can_delete')) {
                $oMnEtForumPost->canDelete->setOriValue($recordForumPost->permission->can_delete);
            }
            if (property_exists($recordForumPost->permission, 'can_move')) {
                $oMnEtForumPost->canMove->setOriValue($recordForumPost->permission->can_move);
            }
            if (property_exists($recordForumPost->permission, 'can_like')) {
                $oMnEtForumPost->canLike->setOriValue($recordForumPost->permission->can_like);
            }
            if (property_exists($recordForumPost->permission, 'can_unlike')) {
                $oMnEtForumPost->canUnlike->setOriValue($recordForumPost->permission->can_unlike);
            }
            if (property_exists($recordForumPost->permission, 'can_thank')) {
                $oMnEtForumPost->canThank->setOriValue($recordForumPost->permission->can_thank);
            }
            if (property_exists($recordForumPost->permission, 'can_unthank')) {
                $oMnEtForumPost->canUnthank->setOriValue($recordForumPost->permission->can_unthank);
            }
            if (property_exists($recordForumPost->permission, 'can_report')) {
                $oMnEtForumPost->canReport->setOriValue($recordForumPost->permission->can_report);
            }
        }
        return $oMnEtForumPost;
    }
    
    /**
     * init objsMnEtForumPost by records
     *
     * @param  Array  $recordsForumPost
     */
    public function initObjsMnEtForumPostByRecords($recordsForumPost) {
        $objsMnEtForumPost = array();
        foreach ($recordsForumPost as $recordForumPost) {
            $objsMnEtForumPost[] = $this->initMnEtForumPostByRecord($recordForumPost);
        }
        return $objsMnEtForumPost;
    }
    
    /**
     * make mnDisplayValue
     *
     * @param  String  $content
     * @return  String
     */
    private function makeMnDisplayValue($content) { //TODO
        $retStr = $content;
        $retStr = preg_replace('/\[url=([^\]]*?)\]([^\[]*?)\[\/url\]/i', '<a href="$1">$2</a>', $retStr);  //convert url bbcode
        $retStr = preg_replace('/\[img\]([^\[]*?)\[\/img\]/i', '<a href="$1" target="_blank"><img src="$1" /></a>', $retStr);  //convert img bbcode
        $retStr = preg_replace('/\[quote\]/i', '<br />&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;', $retStr);  //convert quote bbcode
        $retStr = preg_replace('/\[\/quote\]/i', '<br />&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;', $retStr);  //convert quote bbcode
        return $retStr;
    }
    
}

?>