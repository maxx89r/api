<?php

defined('MBQ_IN_IT') or exit;

/**
 * forum class
 * 
 * @since  2012-7-8
 * @author Wu ZeTao <578014287@qq.com>
 */
Class MbqEtForum extends MbqBaseEntity {
    
    public $forumId;
    public $forumName;
    public $description;
    public $totalTopicNum;  /* Total number of topics in this forum */
    public $parentId;   /* parent's forum ID of this forum, returns -1 if this forum is the root forum */
    public $logoUrl;
    public $newPost;    /* returns true if this forum contains unread topic */
    public $isProtected;
    public $isSubscribed;   /* return true if this forum was subscribed by current user */
    public $canSubscribe;   /* return true if current user can subscribe this forum. Default as true for member. */
    public $url;    /* if it contains a url, it means this forum is just a link to other webpage */
    public $subOnly;
    public $canPost;    /* return false if user cannot create new topic in this forum */
    public $unreadStickyCount;
    public $unreadAnnounceCount;
    public $requirePrefix;
    public $prefixes;
    public $canUpload;  /* return true if the user has authority to upload attachments in this sub-forum. */
    
    public $oParentMbqEtForum;  /* parent forum */
    public $objsSubMbqEtForum;  /* sub forums */
    
    public function __construct() {
        parent::__construct();
        $this->forumId = clone MbqMain::$simpleV;
        $this->forumName = clone MbqMain::$simpleV;
        $this->description = clone MbqMain::$simpleV;
        $this->totalTopicNum = clone MbqMain::$simpleV;
        $this->parentId = clone MbqMain::$simpleV;
        $this->logoUrl = clone MbqMain::$simpleV;
        $this->newPost = clone MbqMain::$simpleV;
        $this->isProtected = clone MbqMain::$simpleV;
        $this->isSubscribed = clone MbqMain::$simpleV;
        $this->canSubscribe = clone MbqMain::$simpleV;
        $this->url = clone MbqMain::$simpleV;
        $this->subOnly = clone MbqMain::$simpleV;
        $this->canPost = clone MbqMain::$simpleV;
        $this->unreadStickyCount = clone MbqMain::$simpleV;
        $this->unreadAnnounceCount = clone MbqMain::$simpleV;
        $this->requirePrefix = clone MbqMain::$simpleV;
        $this->prefixes = clone MbqMain::$simpleV;
        $this->canUpload = clone MbqMain::$simpleV;
        
        $this->oParentMbqEtForum = NULL;
        $this->objsSubMbqEtForum = array();
    }
  
}

?>