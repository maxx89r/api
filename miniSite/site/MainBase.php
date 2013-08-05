<?php
require_once('./AppConfig.php');

/* constants and classes for mobiquo */
define('MBQ_IN_IT', true);  /* is in mobiquo flag */
define('MBQ_DS', DIRECTORY_SEPARATOR);
define('MBQ_PATH', dirname(__FILE__).MBQ_DS.'..'.MBQ_DS.'..'.MBQ_DS.'mobiquo'.MBQ_DS);    /* mobiquo path */
define('MBQ_FRAME_PATH', MBQ_PATH.'mbqFrame'.MBQ_DS);    /* frame path */
/* error constant */
define('MBQ_ERR_TOP', 1);   /* the worst error that must stop the program immediately.we often use this constant in plugin development. */
define('MBQ_ERR_HIGH', 3);  /* serious error that must stop the program immediately for display in html page.we need not use this constant in plugin development,but can use it in other projects development perhaps. */
define('MBQ_ERR_NOT_SUPPORT', 5);  /* not support corresponding function error that must stop the program immediately. */
define('MBQ_ERR_APP', 7);   /* normal error that maked by program logic can be displayed,the program can works continue or not. */
define('MBQ_ERR_INFO', 9);  /* success info that maked by program logic can be displayed,the program can works continue or not. */
define('MBQ_ERR_TOP_NOIO', 11);  /* the worst error that must stop the program immediately and then the MbqIo is not valid,will output error info and stop the program immediately. */
define('MBQ_ENTITY_PATH', MBQ_FRAME_PATH.'entity'.MBQ_DS);    /* entity class path */
define('MBQ_FDT_PATH', MBQ_FRAME_PATH.'fdt'.MBQ_DS);    /* fdt class path */

/** 
 * 主程序基类 
 * 
 * @since  2010-1-1
 * @author Wu ZeTao <578014287@qq.com>
 */
Abstract Class MainBase extends MainApp {
    
    public function __construct() {
        parent::__construct();
        $this->regClass();
        self::$oAppConfig = self::$oClk->newObj('AppConfig');
        $cfg = self::$oAppConfig->getAppCfg();
        self::$oDb->prepareConnect($cfg['db']['dbName'], $cfg['db']['ip'], $cfg['db']['user'], $cfg['db']['pass']);
        /* 预包含的类 */
        self::$oClk->includeClass('FdtSite');
            /* from mobiquo */
        self::$oClk->includeClass('MbqValue');
        self::$oClk->includeClass('MbqBaseEntity');
        self::$oClk->includeClass('MbqBaseFdt');
        self::$oClk->includeClass('MbqFdtConfig');
        self::$oClk->includeClass('MbqFdtBase');
        self::$oClk->includeClass('MbqFdtUser');
        self::$oClk->includeClass('MbqFdtForum');
        self::$oClk->includeClass('MbqFdtPm');
        self::$oClk->includeClass('MbqFdtPc');
        self::$oClk->includeClass('MbqFdtLike');
        self::$oClk->includeClass('MbqFdtSubscribe');
        self::$oClk->includeClass('MbqFdtThank');
        self::$oClk->includeClass('MbqFdtFollow');
        self::$oClk->includeClass('MbqFdtFeed');
        self::$oClk->includeClass('MbqFdtAtt');
        self::$oClk->includeClass('MbqMain');
    }
    
    /**
     * 注册公共类，各个模块中都要用到的类（主要是些实体类及模块字段定义类和接口调用客户端类）
     */
    protected function regPublicClass() {
        parent::regPublicClass();
        $type = self::$oCt->getApp();
        /* SITE模块 */
            /* 实体类 */
                /* mobiquo entity class */
        self::$oClk->reg($type, 'MbqEtSysStatistics', MBQ_ENTITY_PATH.'MbqEtSysStatistics.php');
        self::$oClk->reg($type, 'MbqEtUser', MBQ_ENTITY_PATH.'MbqEtUser.php');
        self::$oClk->reg($type, 'MbqEtForum', MBQ_ENTITY_PATH.'MbqEtForum.php');
        self::$oClk->reg($type, 'MbqEtForumSmilie', MBQ_ENTITY_PATH.'MbqEtForumSmilie.php');
        self::$oClk->reg($type, 'MbqEtForumTopic', MBQ_ENTITY_PATH.'MbqEtForumTopic.php');
        self::$oClk->reg($type, 'MbqEtForumReportPost', MBQ_ENTITY_PATH.'MbqEtForumReportPost.php');
        self::$oClk->reg($type, 'MbqEtForumPost', MBQ_ENTITY_PATH.'MbqEtForumPost.php');
        self::$oClk->reg($type, 'MbqEtAtt', MBQ_ENTITY_PATH.'MbqEtAtt.php');
        self::$oClk->reg($type, 'MbqEtPc', MBQ_ENTITY_PATH.'MbqEtPc.php');
        self::$oClk->reg($type, 'MbqEtPcMsg', MBQ_ENTITY_PATH.'MbqEtPcMsg.php');
        self::$oClk->reg($type, 'MbqEtPcInviteParticipant', MBQ_ENTITY_PATH.'MbqEtPcInviteParticipant.php');
        self::$oClk->reg($type, 'MbqEtPm', MBQ_ENTITY_PATH.'MbqEtPm.php');
        self::$oClk->reg($type, 'MbqEtReportPm', MBQ_ENTITY_PATH.'MbqEtReportPm.php');
        self::$oClk->reg($type, 'MbqEtPmBox', MBQ_ENTITY_PATH.'MbqEtPmBox.php');
        self::$oClk->reg($type, 'MbqEtSubscribe', MBQ_ENTITY_PATH.'MbqEtSubscribe.php');
        self::$oClk->reg($type, 'MbqEtThank', MBQ_ENTITY_PATH.'MbqEtThank.php');
        self::$oClk->reg($type, 'MbqEtFollow', MBQ_ENTITY_PATH.'MbqEtFollow.php');
        self::$oClk->reg($type, 'MbqEtLike', MBQ_ENTITY_PATH.'MbqEtLike.php');
        self::$oClk->reg($type, 'MbqEtFeed', MBQ_ENTITY_PATH.'MbqEtFeed.php');
                /* entity class extended from mobiquo entity class */
        self::$oClk->reg($type, 'MnEtSysStatistics', self::$oCf->getPath(MPF_C_APP_CLASS_PATH_ET).'MnEtSysStatistics.php');
        self::$oClk->reg($type, 'MnEtUser', self::$oCf->getPath(MPF_C_APP_CLASS_PATH_ET).'MnEtUser.php');
        self::$oClk->reg($type, 'MnEtForum', self::$oCf->getPath(MPF_C_APP_CLASS_PATH_ET).'MnEtForum.php');
        self::$oClk->reg($type, 'MnEtForumSmilie', self::$oCf->getPath(MPF_C_APP_CLASS_PATH_ET).'MnEtForumSmilie.php');
        self::$oClk->reg($type, 'MnEtForumTopic', self::$oCf->getPath(MPF_C_APP_CLASS_PATH_ET).'MnEtForumTopic.php');
        self::$oClk->reg($type, 'MnEtForumReportPost', self::$oCf->getPath(MPF_C_APP_CLASS_PATH_ET).'MnEtForumReportPost.php');
        self::$oClk->reg($type, 'MnEtForumPost', self::$oCf->getPath(MPF_C_APP_CLASS_PATH_ET).'MnEtForumPost.php');
        self::$oClk->reg($type, 'MnEtAtt', self::$oCf->getPath(MPF_C_APP_CLASS_PATH_ET).'MnEtAtt.php');
        self::$oClk->reg($type, 'MnEtPc', self::$oCf->getPath(MPF_C_APP_CLASS_PATH_ET).'MnEtPc.php');
        self::$oClk->reg($type, 'MnEtPcMsg', self::$oCf->getPath(MPF_C_APP_CLASS_PATH_ET).'MnEtPcMsg.php');
        self::$oClk->reg($type, 'MnEtPcInviteParticipant', self::$oCf->getPath(MPF_C_APP_CLASS_PATH_ET).'MnEtPcInviteParticipant.php');
        self::$oClk->reg($type, 'MnEtPm', self::$oCf->getPath(MPF_C_APP_CLASS_PATH_ET).'MnEtPm.php');
        self::$oClk->reg($type, 'MnEtReportPm', self::$oCf->getPath(MPF_C_APP_CLASS_PATH_ET).'MnEtReportPm.php');
        self::$oClk->reg($type, 'MnEtPmBox', self::$oCf->getPath(MPF_C_APP_CLASS_PATH_ET).'MnEtPmBox.php');
        self::$oClk->reg($type, 'MnEtSubscribe', self::$oCf->getPath(MPF_C_APP_CLASS_PATH_ET).'MnEtSubscribe.php');
        self::$oClk->reg($type, 'MnEtThank', self::$oCf->getPath(MPF_C_APP_CLASS_PATH_ET).'MnEtThank.php');
        self::$oClk->reg($type, 'MnEtFollow', self::$oCf->getPath(MPF_C_APP_CLASS_PATH_ET).'MnEtFollow.php');
        self::$oClk->reg($type, 'MnEtLike', self::$oCf->getPath(MPF_C_APP_CLASS_PATH_ET).'MnEtLike.php');
        self::$oClk->reg($type, 'MnEtFeed', self::$oCf->getPath(MPF_C_APP_CLASS_PATH_ET).'MnEtFeed.php');
            /* 模块字段定义类 */
        self::$oClk->reg($type, 'FdtSite', self::$oCf->getPath(MPF_C_APP_CLASS_PATH_FDT) . 'FdtSite.php');
                /* from mobiquo */
        self::$oClk->reg($type, 'MbqValue', MBQ_FRAME_PATH.'MbqValue.php');
        self::$oClk->reg($type, 'MbqBaseEntity', MBQ_FRAME_PATH.'MbqBaseEntity.php');
        self::$oClk->reg($type, 'MbqBaseFdt', MBQ_FRAME_PATH.'MbqBaseFdt.php');
        self::$oClk->reg($type, 'MbqDataPage', MBQ_FRAME_PATH.'MbqDataPage.php');
                /* mobiquo fdt class */
        self::$oClk->reg($type, 'MbqFdtConfig', MBQ_FDT_PATH.'MbqFdtConfig.php');
        self::$oClk->reg($type, 'MbqFdtBase', MBQ_FDT_PATH.'MbqFdtBase.php');
        self::$oClk->reg($type, 'MbqFdtUser', MBQ_FDT_PATH.'MbqFdtUser.php');
        self::$oClk->reg($type, 'MbqFdtForum', MBQ_FDT_PATH.'MbqFdtForum.php');
        self::$oClk->reg($type, 'MbqFdtPm', MBQ_FDT_PATH.'MbqFdtPm.php');
        self::$oClk->reg($type, 'MbqFdtPc', MBQ_FDT_PATH.'MbqFdtPc.php');
        self::$oClk->reg($type, 'MbqFdtLike', MBQ_FDT_PATH.'MbqFdtLike.php');
        self::$oClk->reg($type, 'MbqFdtSubscribe', MBQ_FDT_PATH.'MbqFdtSubscribe.php');
        self::$oClk->reg($type, 'MbqFdtThank', MBQ_FDT_PATH.'MbqFdtThank.php');
        self::$oClk->reg($type, 'MbqFdtFollow', MBQ_FDT_PATH.'MbqFdtFollow.php');
        self::$oClk->reg($type, 'MbqFdtFeed', MBQ_FDT_PATH.'MbqFdtFeed.php');
        self::$oClk->reg($type, 'MbqFdtAtt', MBQ_FDT_PATH.'MbqFdtAtt.php');
            /* 客户端接口类 */
            /* other class */
        self::$oClk->reg($type, 'MbqMain', self::$oCf->getPath(MPF_C_APP_CLASS_PATH_ET).'MbqMain.php');
    }
    
    /**
     * 注册应用类，模块中独有的类
     */
    protected function regAppClass() {
        parent::regAppClass();
        $type = self::$oCt->getApp();
        /* 实体读/写/初始化类 */
        /* 权限判断类 */
        /* 实体校验类 */
        /* 主程序代理类 */
        /* 工具类 */
        /* 服务端接口类 */
    }
    
    /**
     * 选择rewrite方式
     *
     * @param  String  $v  为'php'表示用php程序仿rewrite，为'normal'表示通过http服务器配置rewrite，为'none'表示不启用rewrite；
     */
    final protected function selectRewrite($v = 'php') {
        parent::selectRewrite($v);
    }
    
    /**
     * 判断是否已经登录
     *
     * @return  Boolean
     */
    final public function hasLogin() {
        return false;
    }
    
}

?>