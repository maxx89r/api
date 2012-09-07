<?php

defined('MBQ_IN_IT') or exit;

/**
 * application environment base class
 * 
 * @since  2012-7-2
 * @author Wu ZeTao <578014287@qq.com>
 */
Abstract Class MbqBaseAppEnv {
    
    //the following is the proposed properties may need be used by your application environment.
    public $db;         //application db
    public $user;       //application current login user
    public $config;     //application config
    public $cache;      //application cache
    
    public function __construct() {
    }
    
    /**
     * application environment init
     */
    abstract protected function init();
  
}

?>