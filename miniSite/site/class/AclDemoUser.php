<?php
/**
 * 用户权限判断类
 * 
 * @since  2010-1-1
 * @author Wu ZeTao <578014287@qq.com>
 */
Class AclDemoUser Extends AppDo {

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * 判断能否登录
     *
     * @return  Boolean
     */
    public function canAclDemoLogin() {
        return true;
    }
    
    /**
     * 判断能否列表用户
     *
     * @param  Object  $oMain  主程序对象
     * @param  Object  $CDemoUserEt  当前登陆用户实体对象
     * @return  Boolean
     */
    public function canAclDemoLsDemoUser($oMain, $CDemoUserEt) {
        if ($oMain->hasLogin() && $CDemoUserEt->isOkStatus()) {
            return true;
        }
        return false;
    }
    
}

?>