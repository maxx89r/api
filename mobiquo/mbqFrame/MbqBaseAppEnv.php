<?php

defined('MBQ_IN_IT') or exit;

/**
 * application environment base class
 * 
 * @since  2012-7-2
 * @author Wu ZeTao <578014287@qq.com>
 */
Abstract Class MbqBaseAppEnv {
    
    public function __construct() {
    }
    
    /**
     * application environment init
     */
    abstract protected function init();
  
}

?>