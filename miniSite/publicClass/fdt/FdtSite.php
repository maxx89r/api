<?php
/**
 * SITE模块的字段定义类
 * 
 * @since  2010-1-1
 * @author Wu ZeTao <578014287@qq.com>
 */
Abstract Class FdtSite {
    
    /* 对应于mpf_demo_user表 */
    /* 开发规范：以tb_开头，表示对应某个表或逻辑对象。 */
    public static $tb_demo_user = array(
        'fddf_user_status' => 1, /* user_status字段默认值 */  /* 开发规范：以fddf_开头，表示对应某个字段的默认值。 */
        
        'fd_user_status'    => array (  /* user_status字段取值范围 */   /* 开发规范：以fd_开头，表示对应某个字段的取值范围。 */
            'ok' => array (
                'v' => 1,
                't' => '正常'
            ),
            'del' => array (
                'v' => 2,
                't' => '删除'
            )
        )
    );
    
    /* 其他某种定义 */
    /* 开发规范：以ot_开头，表示其他某种定义 */
    public static $ot_test = array (
    );

    /**
     * 构造函数
     */
    public function __construct() {
    }
    
}
Fdt::$df['FdtSite']['tb_demo_user'] = &FdtSite::$tb_demo_user;
Fdt::$df['FdtSite']['ot_test'] = &FdtSite::$ot_test;

?>