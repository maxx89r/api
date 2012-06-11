<?php

defined('IN_MOBIQUO') or exit;

function get_subscribed_forum_func()
{
    if (empty($_COOKIE['uid'])) 
        return xmlrespfalse("Please login!");
    
    include('./test_data/data.php');
    
    $uid = $_COOKIE['uid'];
    if (!$uid || !isset($users[$uid])) 
        return xmlrespfalse("User not exist!");
    
    $forum_list = array();
    foreach($subscribe_info as $s_info) {
        if ($s_info['type'] == 'forum' && $s_info['uid'] == $uid) {
            $forum = $forums[$s_info['id']];
            
            $logo_url = get_forum_icon_url($forum['forum_id']);
                if (!$logo_url) $logo_url = $forum['logo_url'];
            
            $forum_list[] = new xmlrpcval(array(
                'forum_id'      => new xmlrpcval($forum['forum_id'], 'string'),
                'forum_name'    => new xmlrpcval($forum['forum_name'], 'base64'),
                'icon_url'      => new xmlrpcval($logo_url, 'string'),
                'new_post'      => new xmlrpcval($forum['new_post'], 'boolean'),
                'is_protected'  => new xmlrpcval($forum['is_protected'], 'boolean'),
                'sub_only'      => new xmlrpcval($forum['sub_only'], 'boolean'),
            ), 'struct');
        }
    }
    
    $result = new xmlrpcval(array(
        'total_forums_num' => new xmlrpcval(count($forum_list), 'int'),
        'forums'           => new xmlrpcval($forum_list, 'array')
    ), 'struct');

    return new xmlrpcresp($result);
}
