<?php

/**
 * push class
 * 
 * @since  2013-7-10
 * @author Wu ZeTao <578014287@qq.com>
 */
Class TapatalkPush extends TapatalkBasePush {
    
    //init
    //attention!!!In other do something method,must call self::init() method to init basic properties of this class
    static public function init() {
        parent::init();
        if (!self::$hasInit) {
            //here to do init work
            
        }
        self::$hasInit = true;
    }
    
}

?>