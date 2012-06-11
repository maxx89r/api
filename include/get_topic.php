<?php

defined('IN_MOBIQUO') or exit;

function get_topic_func($xmlrpc_params)
{
    $params = php_xmlrpc_decode($xmlrpc_params);

    $forum_id   = $params[0];
    $start_num  = $params[1];
    $last_num   = $params[2];
    $mode       = isset($params[3]) ? $params[3] : '';
    
    include('./test_data/data.php');
    list($start, $limit) = process_page($start_num, $last_num);
    
    $forum = $forums[$forum_id];
    if (!$forum) 
        return xmlrespfalse("Forum id '$forum_id' not exist!");
    
    $ids = array();
    foreach(array_reverse($topics) as $topic)
    {
        if ($topic['forum_id'] == $forum_id)
        {
            if ($mode == 'TOP') {
                if ($topic['is_sticky']) $ids[] = $topic['topic_id'];
            } elseif ($mode == 'ANN') {
                if ($topic['is_announcement']) $ids[] = $topic['topic_id'];
            } else {
                if (!$topic['is_sticky'] && !$topic['is_announcement']) $ids[] = $topic['topic_id'];
            }
        }
    }
    
    $result_ids = array_slice($ids, $start, $limit);
    $topic_list = array();
    foreach($result_ids as $tid)
    {
        $topic = $topics[$tid];
        $post = $posts[$topic['last_post_id']];
        $content = $posts[$topic['last_post_id']]['post_content'];
        $topic_list[] = new xmlrpcval(array(
            'forum_id'          => new xmlrpcval($topic['forum_id'], 'string'),
            'forum_name'        => new xmlrpcval($forum['forum_name'], 'base64'),
            'topic_id'          => new xmlrpcval($tid, 'string'),
            'topic_title'       => new xmlrpcval($topic['topic_title'], 'base64'),
            'topic_author_name' => new xmlrpcval($users[$post['author_id']]['user_name'], 'base64'),
    'topic_author_display_name' => new xmlrpcval($users[$post['author_id']]['display_name'], 'base64'),
            'can_subscribe'     => new xmlrpcval($topic['can_subscribe'], 'boolean'),
            'is_subscribed'     => new xmlrpcval($topic['is_subscribed'], 'boolean'),
            'is_closed'         => new xmlrpcval($topic['is_closed'], 'boolean'),
            'short_content'     => new xmlrpcval(cutstr($content, 200), 'base64'),
            'icon_url'          => new xmlrpcval($users[$post['author_id']]['icon_url'], 'string'),
            'last_reply_time'   => new xmlrpcval(mobiquo_iso8601_encode($post['post_time']), 'dateTime.iso8601'),
            'reply_number'      => new xmlrpcval($topic['reply_number'], 'int'),
            'view_number'       => new xmlrpcval($topic['view_number'], 'int'),
            'new_post'          => new xmlrpcval($topic['new_post'], 'boolean'),
        ), 'struct');
    }
    
    $prefixes = array();
    if ($forum['require_prefix']) {
        foreach($forum['prefixes'] as $prefix) {
            $prefixes[] = new xmlrpcval(array(
                'prefix_id'             => new xmlrpcval($prefix['id'], 'string'),
                'prefix_display_name'   => new xmlrpcval($prefix['name'], 'base64'),
            ), 'struct');
        }
    }
    
    $result = new xmlrpcval(array(
        'total_topic_num' => new xmlrpcval(count($ids), 'int'),
        'forum_id'        => new xmlrpcval($forum_id, 'string'),
        'forum_name'      => new xmlrpcval($forum['forum_name'], 'base64'),
        'can_post'        => new xmlrpcval($forum['can_post'], 'boolean'),
        'require_prefix'  => new xmlrpcval($forum['require_prefix'], 'boolean'),
        'prefixes'        => new xmlrpcval($prefixes, 'array'),
        'topics'          => new xmlrpcval($topic_list, 'array'),
    ), 'struct');

    return new xmlrpcresp($result);
}
