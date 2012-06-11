<?php

defined('IN_MOBIQUO') or exit;

function get_forum_func()
{
    include('./test_data/data.php');
    
    
    // remove orphan forums
    foreach($forums as $id => $value)
        if ($value['parent_id'] != 0 && !isset($forums[$value['parent_id']]))
            unset($forum_rows[$id]);
    
    $forum_rows[0] = array('parent_id' => -1, 'child' => array());
    while(empty($forums[0]['child']) && count($forums) > 1)
    {
        $parents = array();
        foreach($forums as $forum)
            $parents[$forum['parent_id']] = 1;
        
        foreach($forums as $id => $forum)
        {
            if (!in_array($id, array_keys($parents)))
            {
                $logo_url = get_forum_icon_url($id);
                if (!$logo_url) $logo_url = $forum['logo_url'];
                
                $xmlrpc_forum = new xmlrpcval(array(
                    'forum_id'      => new xmlrpcval($id, 'string'),
                    'forum_name'    => new xmlrpcval($forum['forum_name'], 'base64'),
                    'description'   => new xmlrpcval($forum['description'], 'base64'),
                    'parent_id'     => new xmlrpcval($forum['parent_id']),
                    'logo_url'      => new xmlrpcval($logo_url, 'string'),
                    'new_post'      => new xmlrpcval($forum[$new_post], 'boolean'),
                    'unread_count'  => new xmlrpcval($forum['unread_count'], 'int'),
                    'is_protected'  => new xmlrpcval($forum['is_protected'], 'boolean'),
                    'url'           => new xmlrpcval($forum['url'], 'string'),
                    'sub_only'      => new xmlrpcval($forum['sub_only'], 'boolean'),
                    'can_subscribe' => new xmlrpcval($forum['can_subscribe'], 'boolean'),
                    'is_subscribed' => new xmlrpcval($forum['is_subscribed'], 'boolean'),
                ), 'struct');
                
                if (isset($forums[$id]['child']))
                {
                    $xmlrpc_forum->addStruct(array('child' => new xmlrpcval($forums[$id]['child'], 'array')));
                }
                
                $forums[$forum['parent_id']]['child'][] = $xmlrpc_forum;
                unset($forums[$id]);
            }
        }
    }
    
    $response = new xmlrpcval($forums[0]['child'], 'array');
    
    return new xmlrpcresp($response);
}