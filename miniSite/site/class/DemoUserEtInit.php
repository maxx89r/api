<?php
/**
 * 用户实体初始化类
 * 
 * @since  2010-1-1
 * @author Wu ZeTao <578014287@qq.com>
 */
Class DemoUserEtInit Extends AppDo {

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * 根据$uid初始化对应的用户实体对象
     *
     * @param  Integer  $uid  用户id
     * @return  Mixed  初始化成功则返回对应的对象，否则返回false
     */
    public function initDemoUserEtById($uid) {
        $sql = "select * from ".$this->tbPrefix."demo_user where uid = '".addslashes($uid)."'";
        $result = $this->oDb->doQuery($sql, __METHOD__ . ',line:' . __LINE__ . '.' . 'Can not read!');
        if ($record = mysql_fetch_array($result)) {
            $oDemoUserEt = MainApp::$oClk->newObj('DemoUserEt');
            $oDemoUserEt->initByRecord($record);
            return $oDemoUserEt;
        } else {
            return false;
        }
    }
    
}

?>