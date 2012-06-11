<?php

defined('IN_MOBIQUO') or exit;

function search_topic_func($xmlrpc_params)
{
    $params = php_xmlrpc_decode($xmlrpc_params);

    $search_key = $params[0];
    $start_num  = $params[1];
    $last_num   = $params[2];
    $search_id  = $params[3];
    
    include('./test_data/data.php');
    list($start, $limit) = process_page($start_num, $last_num);
    
    $ids = array();
    foreach($topics as $topic)
    {
        if (strpos($posts[$topic['first_post_id']]['post_title'], $search_key) !== false ||
            strpos($posts[$topic['first_post_id']]['post_content'], $search_key) !== false)
        {
            $ids[] = $topic['topic_id'];
            if (count($ids) >= 500) break; // we don't need that more
        }
    }
    
    $result_ids = array_slice($ids, $start, $limit);
    $topic_list = array();
    foreach($result_ids as $tid)
    {
        $topic = $topics[$tid];
        $post = $posts[$topic['first_post_id']];
        $content = $posts[$topic['first_post_id']]['post_content'];
        $topic_list[] = new xmlrpcval(array(
            'forum_id'          => new xmlrpcval($topic['forum_id'], 'string'),
            'forum_name'        => new xmlrpcval($forums[$topic['forum_id']]['forum_name'], 'base64'),
            'topic_id'          => new xmlrpcval($tid, 'string'),
            'topic_title'       => new xmlrpcval($topic['topic_title'], 'base64'),
            'post_author_name'  => new xmlrpcval($users[$post['author_id']]['user_name'], 'base64'),
    'post_author_display_name'  => new xmlrpcval($users[$post['author_id']]['display_name'], 'base64'),
            'can_subscribe'     => new xmlrpcval($topic['can_subscribe'], 'boolean'),
            'is_subscribed'     => new xmlrpcval($topic['is_subscribed'], 'boolean'),
            'is_closed'         => new xmlrpcval($topic['is_closed'], 'boolean'),
            'short_content'     => new xmlrpcval(cutstr($content, 200), 'base64'),
            'icon_url'          => new xmlrpcval($users[$post['author_id']]['icon_url'], 'string'),
            'post_time'         => new xmlrpcval(mobiquo_iso8601_encode($post['post_time']), 'dateTime.iso8601'),
            'reply_number'      => new xmlrpcval($topic['reply_number'], 'int'),
            'view_number'       => new xmlrpcval($topic['view_number'], 'int'),
            'new_post'          => new xmlrpcval($topic['new_post'], 'boolean'),
        ), 'struct');
    }
    
    $result = new xmlrpcval(array(
        'total_topic_num' => new xmlrpcval(count($ids), 'int'),
        'search_id'       => new xmlrpcval('', 'string'),
        'topics'          => new xmlrpcval($topic_list, 'array')
    ), 'struct');

    return new xmlrpcresp($result);
}
