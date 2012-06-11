<?php

defined('IN_MOBIQUO') or exit;

function get_inbox_stat_func()
{
    if (empty($_COOKIE['uid'])) 
        return xmlrespfalse("Please login!");
    
    include('./test_data/data.php');
    
    $uid = $_COOKIE['uid'];
    if (!$uid || !isset($users[$uid])) 
        return xmlrespfalse("User not exist!");
    
    $unread_count = 0;
    foreach($messages as $message)
        if($message['to'] == $uid && $message['stat'] == UNREAD)
            $unread_count++;
    
    $result = new xmlrpcval(array(
        'inbox_unread_count' => new xmlrpcval($unread_count, 'int')
    ), 'struct');

    return new xmlrpcresp($result);
}
