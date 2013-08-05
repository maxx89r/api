<?php
require_once('./MainBase.php');

/** 
 * 首页 
 * 
 * @since  2010-1-1
 * @author Wu ZeTao <578014287@qq.com>
 */
Class MainTopic extends MainBase {
    
    public function __construct() {
        parent::__construct();
        self::selectRewrite('none');
        
        $this->initSession();
    }
    
    /**
     * thread list
     */
    public function threadList() {
        self::$cmd = 'threadList';
        /* init */
        self::$title = "thread list";
        /* verify */
        /* acl */
        /* do */
        /* end */
        $this->setTpl('threadList.html');
    }
    
    /**
     * get thread
     */
    public function getThread() {
        self::$cmd = 'getThread';
        /* init */
        self::$title = "get thread";
        /* verify */
        /* acl */
        /* do */
        /* end */
        $this->setTpl('getThread.html');
    }
    
    public function run() {
        switch (self::$cmd) {
            case 'threadList':
                $this->threadList();
                break;
            case 'getThread':
                $this->getThread();
                break;
            default:
                self::$oCf->pageReturn('', '', 'MainForum.php', 'forumList', '', array('status' => ERR_APP, 'info' => MainApp::$oCf->_L('cm_param_error')));
                break;
        }
    }
    
    public function cmEnd() {
        parent::cmEnd();
    }
    
}

$html = new MainTopic();
$html->run();
$html->cmEnd();
$html->display();

?>