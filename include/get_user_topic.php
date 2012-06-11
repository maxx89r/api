<?php

defined('IN_MOBIQUO') or exit;

function get_user_topic_func($xmlrpc_params)
{
    $params = php_xmlrpc_decode($xmlrpc_params);

    $username = $params[0];
    
    include('./test_data/data.php');
    
    $uid = $user_name_id[$username];
    if (!$uid || !isset($users[$uid])) 
        return xmlrespfalse("User '$username' not exist!");
    
    $topic_list = array();
    foreach($topics as $topic) {
        if ($posts[$topic['first_post_id']]['author_id'] == $uid) {
            $last_reply_author_id = $posts[$topic['last_post_id']]['author_id'];
            $last_content = $posts[$topic['last_post_id']]['post_content'];
            
            $topic_list[] = new xmlrpcval(array(
                'forum_id'          => new xmlrpcval($topic['forum_id'], 'string'),
                'forum_name'        => new xmlrpcval($forums[$topic['forum_id']]['forum_name'], 'base64'),
                'topic_id'          => new xmlrpcval($topic['topic_id'], 'string'),
                'topic_title'       => new xmlrpcval($topic['topic_title'], 'base64'),
     'last_reply_author_name'       => new xmlrpcval($users[$last_reply_author_id]['user_name'], 'base64'),
    'last_reply_author_display_name'=> new xmlrpcval($users[$last_reply_author_id]['display_name'], 'base64'),
                'short_content'     => new xmlrpcval(cutstr($last_content, 200), 'base64'),
                'icon_url'          => new xmlrpcval($users[$last_reply_author_id]['icon_url'], 'string'),
                'last_reply_time'   => new xmlrpcval(mobiquo_iso8601_encode($posts[$topic['last_post_id']]['post_time']), 'dateTime.iso8601'),
                'reply_number'      => new xmlrpcval($topic['reply_number'], 'int'),
                'view_number'       => new xmlrpcval($topic['view_number'], 'int'),
                'new_post'          => new xmlrpcval($topic['new_post'], 'boolean'),
            ), 'struct');
        }
        
        if (count($topic_list) > 20) break; // currently, we only need to return at most 20 topics
    }
    
    $response = new xmlrpcval($topic_list, 'array');
    
    return new xmlrpcresp($response);
}
