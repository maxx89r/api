<?php

defined('IN_MOBIQUO') or exit;

function delete_message_func($xmlrpc_params)
{
    $params = php_xmlrpc_decode($xmlrpc_params);

    $message_id = $params[0];
    $box_id     = $params[1];
    
    if (empty($_COOKIE['uid'])) 
        return xmlrespfalse("Please login!");
    
    include('./test_data/data.php');
    
    $uid = $_COOKIE['uid'];
    if (!$uid || !isset($users[$uid])) 
        return xmlrespfalse("User not exist!");
    
    if (!isset($messages[$message_id]))
        return xmlrespfalse("Message not exist!");
    
    $message = $messages[$message_id];
    $msg_to = $message['to'];
    if (!is_array($msg_to))
        $msg_to = array($msg_to);
    
    if ($box_id == 'sent' && $message['from'] != $uid)
        return xmlrespfalse("Message not exist!");
    
    if ($box_id == 'inbox' && !in_array($uid, $msg_to))
        return xmlrespfalse("Message not exist!");
    
    // do delete pm message here
    
    return xmlresptrue();
}
