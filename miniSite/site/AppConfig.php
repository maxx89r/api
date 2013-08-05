<?php
define('MPF_C_APPNAME', 'SITE');    /* 模块名 */
require_once('../MpfGlobalConfig.php');

/** 
 * 模块配置 
 * 
 * @since  2010-1-1
 * @author Wu ZeTao <578014287@qq.com>
 */

/* 模块自定义常量 */


/** 
 * 模块配置类 
 */
Class AppConfig Extends AppConfigBase {

    /**
     * 构造函数
     */
    public function __construct() {
        global $mpf_config;
        parent::__construct();
        
        $this->appCfg['db'] = array (    /* 数据库配置，只有底层程序可以直接访问这个配置，其他程序一律不得直接访问。 */
            'dbName' => '',  /* 数据库名 */
            'ip' => '',  /* ip地址 */
            'user' => '',  /* 用户名 */
            'pass' => ''  /* 密码 */
        );
        
        $this->interfaceSetting = array (    /* 模块间接口配置，只有底层程序可以直接访问这个配置，其他程序一律不得直接访问。 */
            'apps' => $mpf_config['apps'],  /* 各个模块的配置 */
            'interface' => array (  /* 接口配置 */
            )
        );
    }
    
}

?>