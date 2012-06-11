<?php

defined('IN_MOBIQUO') or exit;

function get_box_info_func()
{
    if (empty($_COOKIE['uid'])) 
        return xmlrespfalse("Please login!");
    
    include('./test_data/data.php');
    
    $uid = $_COOKIE['uid'];
    if (!$uid || !isset($users[$uid])) 
        return xmlrespfalse("User not exist!");
    
    $inbox_count = $sent_count = $unread_count = 0;
    foreach($messages as $message) {
        if ($message['to'] == $uid) {
            $inbox_count++;
            if ($message['stat'] == UNREAD) $unread_count++;
        } elseif ($message['from'] == $uid) {
            $sent_count++;
        }
    }
    
    // remaining message quota
    $message_room_count = 99;
    
    $result = new xmlrpcval(array(
        'result'             => new xmlrpcval(true, 'boolean'),
        'message_room_count' => new xmlrpcval($message_room_count, 'int'),
        'list'               => new xmlrpcval(array(
                                    new xmlrpcval(array(
                                        'box_id'        => new xmlrpcval('inbox', 'string'),
                                        'box_name'      => new xmlrpcval('Inbox', 'base64'),
                                        'msg_count'     => new xmlrpcval($inbox_count, 'int'),
                                        'unread_count'  => new xmlrpcval($unread_count, 'int'),
                                        'box_type'      => new xmlrpcval('INBOX', 'string')
                                    ), 'struct'),
                                    new xmlrpcval(array(
                                        'box_id'        => new xmlrpcval('sent', 'string'),
                                        'box_name'      => new xmlrpcval('Sent', 'base64'),
                                        'msg_count'     => new xmlrpcval($sent_count, 'int'),
                                        'unread_count'  => new xmlrpcval(0, 'int'),
                                        'box_type'      => new xmlrpcval('SENT', 'string')
                                    ), 'struct'),
        ), 'array'),
    ), 'struct');

    return new xmlrpcresp($result);
}