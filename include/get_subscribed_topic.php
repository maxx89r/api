<?php

defined('IN_MOBIQUO') or exit;

function get_subscribed_topic_func()
{
    if (empty($_COOKIE['uid'])) 
        return xmlrespfalse("Please login!");
    
    include('./test_data/data.php');
    
    $uid = $_COOKIE['uid'];
    if (!$uid || !isset($users[$uid])) 
        return xmlrespfalse("User not exist!");
    
    $topic_list = array();
    $count = 0;
    foreach($subscribe_info as $s_info) {
        if ($s_info['type'] == 'topic' && $s_info['uid'] == $uid) {
            // we don't need to return all, but need count the number.
            // you'd better order the topics by post time or last reply time desc
            $count++;
            if ($count > 20) continue;
            
            $topic = $topics[$s_info['id']];
            $forum = $forums[$topic['forum_id']];
            $post = $posts[$topic['last_post_id']];
            
            $topic_list[] = new xmlrpcval(array(
                'forum_id'          => new xmlrpcval($forum['forum_id'], 'string'),
                'forum_name'        => new xmlrpcval($forum['forum_name'], 'base64'),
                'topic_id'          => new xmlrpcval($topic['topic_id'], 'string'),
                'topic_title'       => new xmlrpcval($topic['topic_title'], 'base64'),
                'post_author_name'  => new xmlrpcval($users[$post['author_id']]['user_name'], 'base64'),
        'post_author_display_name'  => new xmlrpcval($users[$post['author_id']]['display_name'], 'base64'),
                'is_closed'         => new xmlrpcval($topic['is_closed'], 'boolean'),
                'short_content'     => new xmlrpcval(cutstr($post['post_content'], 200), 'base64'),
                'icon_url'          => new xmlrpcval($users[$post['author_id']]['icon_url'], 'string'),
                'post_time'         => new xmlrpcval(mobiquo_iso8601_encode($post['post_time']), 'dateTime.iso8601'),
                'reply_number'      => new xmlrpcval($topic['reply_number'], 'int'),
                'view_number'       => new xmlrpcval($topic['view_number'], 'int'),
                'new_post'          => new xmlrpcval($topic['new_post'], 'boolean'),
            ), 'struct');
        }
    }
    
    
    $result = new xmlrpcval(array(
        'total_topic_num' => new xmlrpcval($count, 'int'),
        'topics'          => new xmlrpcval($topic_list, 'array')
    ), 'struct');

    return new xmlrpcresp($result);
}

