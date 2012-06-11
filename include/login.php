<?php

defined('IN_MOBIQUO') or exit;

function login_func($xmlrpc_params)
{
    $params = php_xmlrpc_decode($xmlrpc_params);

    $username = $params[0];
    $password = $params[1];
    
    include('./test_data/data.php');
    
    $uid = $user_name_id[$username];
    
    if (!$uid || !isset($users[$uid])) 
        return xmlrespfalse("This is Tapatalk starter kit, try below username with any password for test:\nuser_1\nuser_2\nuser_3\n");
    
    // check user account here
    // more cookie infor is needed for your build 
    setcookie('uid', $uid);
    
    return xmlresptrue();
}
