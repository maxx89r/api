<?php

defined('IN_MOBIQUO') or exit;

function get_message_func($xmlrpc_params)
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
    
    $msg_to_list = array();
    foreach($msg_to as $to_uid) {
        $msg_to_list[] = new xmlrpcval(array(
            'username'     => new xmlrpcval($users[$to_uid]['user_name'], 'base64'),
            'display_name' => new xmlrpcval($users[$to_uid]['display_name'], 'base64'),
        ), 'struct');
    }
    
    $display_user = ($box_id == 'inbox') ? $message['from'] : $msg_to[0];
    
    $result = new xmlrpcval(array(
        'result'        => new xmlrpcval(true, 'boolean'),
        'msg_from'      => new xmlrpcval($users[$message['from']]['user_name'], 'base64'),
'msg_from_display_name' => new xmlrpcval($users[$message['from']]['display_name'], 'base64'),
        'msg_to'        => new xmlrpcval($msg_to_list, 'array'),
        'icon_url'      => new xmlrpcval($users[$display_user]['icon_url'], 'string'),
        'sent_date'     => new xmlrpcval(mobiquo_iso8601_encode($message['time']), 'dateTime.iso8601'),
        'msg_subject'   => new xmlrpcval($message['title'], 'base64'),
        'text_body'     => new xmlrpcval(cutstr($message['content'], 200), 'base64'),
        'is_online'     => new xmlrpcval(in_array($display_user, array_keys($online_user)), 'boolean'),
    ), 'struct');

    return new xmlrpcresp($result);
}
