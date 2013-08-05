<?php
/**
 * 用户实体读类
 * 
 * @since  2010-1-1
 * @author Wu ZeTao <578014287@qq.com>
 */
Class DemoUserEtRd Extends AppDo {

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * 登录
     *
     * @param  Object  $oDemoUserEt  用户实体对象
     * @return  Boolean  登陆成功返回true，否则返回false
     */
    public function doDemoLogin($oDemoUserEt) {
        $sql = "select * from ".$this->tbPrefix."demo_user where lg_name = '".addslashes($oDemoUserEt->get_lgName())."' and upass = '".addslashes($oDemoUserEt->get_upass())."'";
        $result = $this->oDb->doQuery($sql, __METHOD__ . ',line:' . __LINE__ . '.' . 'Can not read!');
        if ($record = mysql_fetch_array($result)) {
            $oDemoUserEt->initByRecord($record);
            MainApp::$oSession->sessionStart();
            MainApp::$oSession->setVar('CDemoUserEt', $oDemoUserEt);
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * 列表用户
     *
     * @param  Object  $oAppPage  分页类对象
     */
    public function doDemoDemoUserLs($oAppPage) {
        $sql = "select * from ".$this->tbPrefix."demo_user";
        $result = $this->oDb->doQuery($sql, __METHOD__ . ',line:' . __LINE__ . '.' . 'Can not read!');
        $oAppPage->init($this->oDb, MainApp::$pg, 2);
        $objsDemoUserEt = array();
        $i = 0;
        foreach ($oAppPage->rows as $record) {
            $objsDemoUserEt[$i] = MainApp::$oClk->newObj('DemoUserEt');
            $objsDemoUserEt[$i]->initByRecord($record);
            $i ++;
        }
        return $objsDemoUserEt;
    }
    
}

?>