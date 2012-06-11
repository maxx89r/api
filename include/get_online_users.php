<?php

defined('IN_MOBIQUO') or exit;

function get_online_users_func()
{
    include('./test_data/data.php');
    
    $user_lists = array();
    foreach($online_user as $uid => $user){
        $user_lists[] = new xmlrpcval(array(
            'user_name'     => new xmlrpcval($users[$uid]['user_name'], 'base64'),
            'display_name'  => new xmlrpcval($users[$uid]['display_name'], 'base64'),
            'display_text'  => new xmlrpcval($user['display_text'], 'base64'),
            'icon_url'      => new xmlrpcval($users[$uid]['icon_url'], 'string'),
        ), 'struct');
    }
    
    $online_users = new xmlrpcval(array(
        'member_count' => new xmlrpcval($board_info['member_online'], 'int'),
        'guest_count'  => new xmlrpcval($board_info['guest_online'], 'int'),
        'list'         => new xmlrpcval($user_lists, 'array'),
    ), 'struct');

    return new xmlrpcresp($online_users);
}
