<?php

defined('IN_MOBIQUO') or exit;

function get_user_reply_post_func($xmlrpc_params)
{
    $params = php_xmlrpc_decode($xmlrpc_params);

    $username = $params[0];
    
    include('./test_data/data.php');
    
    $uid = $user_name_id[$username];
    if (!$uid || !isset($users[$uid])) 
        return xmlrespfalse("User '$username' is not exist!");
    
    $post_list = array();
    foreach($posts as $post) {
        if ($post['author_id'] == $uid) {
            $post_list[] = new xmlrpcval(array(
                'forum_id'          => new xmlrpcval($post['forum_id'], 'string'),
                'forum_name'        => new xmlrpcval($forums[$post['forum_id']]['forum_name'], 'base64'),
                'topic_id'          => new xmlrpcval($post['topic_id'], 'string'),
                'topic_title'       => new xmlrpcval($topics[$post['topic_id']]['topic_title'], 'base64'),
                'post_id'           => new xmlrpcval($post['post_id'], 'string'),
                'post_time'         => new xmlrpcval(mobiquo_iso8601_encode($post['post_time']), 'dateTime.iso8601'),
                'short_content'     => new xmlrpcval(cutstr($post['post_content'], 200), 'base64'),
                'icon_url'          => new xmlrpcval($users[$post['author_id']]['icon_url'], 'string'),
                'reply_number'      => new xmlrpcval($topics[$post['topic_id']]['reply_number'], 'int'),
                'view_number'       => new xmlrpcval($topics[$post['topic_id']]['view_number'], 'int'),
                'new_post'          => new xmlrpcval($topics[$post['topic_id']]['new_post'], 'boolean'),
            ), 'struct');
        }
        
        if (count($post_list) > 20) break; // currently, we only need to return at most 20 posts
    }
    
    $response = new xmlrpcval($post_list, 'array');
    
    return new xmlrpcresp($response);
}
