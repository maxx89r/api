<?php
/**
 * 用户实体校验类
 * 
 * @since  2010-1-1
 * @author Wu ZeTao <578014287@qq.com>
 */
Class DemoUserEtV Extends AppDo {

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * 校验用户登录名
     *
     * @param  String  $v  用户登录名
     * @return  Boolean
     */
    public function vLgName($v) {
        if (mb_strlen($v) > 0) {
            return true;
        }
        return false;
    }
    
}

?>