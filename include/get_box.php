<?php

defined('IN_MOBIQUO') or exit;

function get_box_func($xmlrpc_params)
{
    $params = php_xmlrpc_decode($xmlrpc_params);

    $box_id     = $params[0];
    $start_num  = $params[1];
    $last_num   = $params[2];
    
    list($start, $limit) = process_page($start_num, $last_num);
    
    if (empty($_COOKIE['uid'])) 
        return xmlrespfalse("Please login!");
    
    include('./test_data/data.php');
    
    $uid = $_COOKIE['uid'];
    if (!$uid || !isset($users[$uid])) 
        return xmlrespfalse("User not exist!");
    
    $ids = array();
    $message_count = $unread_count = 0;
    foreach($messages as $message) {
        if ($box_id == 'inbox' && $message['to'] == $uid) {
            $message_count++;
            if ($message['stat'] == UNREAD) $unread_count++;
            $ids[] = $message['mid'];
        } elseif ($box_id == 'sent' && $message['from'] == $uid) {
            $message_count++;
            $ids[] = $message['mid'];
        }
    }
    
    $result_ids = array_slice($ids, $start, $limit);
    $message_list = array();
    foreach($result_ids as $mid)
    {
        $message = $messages[$mid];
        $msg_to = $message['to'];
        if (!is_array($msg_to))
            $msg_to = array($msg_to);
        
        $msg_to_list = array();
        foreach($msg_to as $to_uid) {
            $msg_to_list[] = new xmlrpcval(array(
                'username'     => new xmlrpcval($users[$to_uid]['user_name'], 'base64'),
                'display_name' => new xmlrpcval($users[$to_uid]['display_name'], 'base64'),
            ), 'struct');
        }
        
        $display_user = ($box_id == 'inbox') ? $message['from'] : $msg_to[0];
        
        $message_list[] = new xmlrpcval(array(
            'msg_id'        => new xmlrpcval($mid, 'string'),
            'msg_state'     => new xmlrpcval($message['stat'], 'int'),
            'sent_date'     => new xmlrpcval(mobiquo_iso8601_encode($message['time']), 'dateTime.iso8601'),
            'msg_from'      => new xmlrpcval($users[$message['from']]['user_name'], 'base64'),
    'msg_from_display_name' => new xmlrpcval($users[$message['from']]['display_name'], 'base64'),
            'icon_url'      => new xmlrpcval($users[$display_user]['icon_url'], 'string'),
            'msg_to'        => new xmlrpcval($msg_to_list, 'array'),
            'msg_subject'   => new xmlrpcval($message['title'], 'base64'),
            'short_content' => new xmlrpcval(cutstr($message['content'], 200), 'base64'),
            'is_online'     => new xmlrpcval(in_array($display_user, array_keys($online_user)), 'boolean'),
        ), 'struct');
    }
    
    $result = new xmlrpcval(array(
        'result'              => new xmlrpcval(true, 'boolean'),
        'total_message_count' => new xmlrpcval($message_count, 'int'),
        'total_unread_count'  => new xmlrpcval($unread_count, 'int'),
        'list'                => new xmlrpcval($message_list, 'array'),
    ), 'struct');

    return new xmlrpcresp($result);
}
