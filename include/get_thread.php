<?php

defined('IN_MOBIQUO') or exit;

function get_thread_func($xmlrpc_params)
{
    $params = php_xmlrpc_decode($xmlrpc_params);

    $topic_id = $params[0];
    $start_num  = $params[1];
    $last_num   = $params[2];
    
    include('./test_data/data.php');
    list($start, $limit) = process_page($start_num, $last_num);
    
    $topic = $topics[$topic_id];
    $forum = $forums[$topic['forum_id']];
    if (!$topic) 
        return xmlrespfalse("Topic id '$topic_id' not exist!");
    
    $ids = array();
    foreach($posts as $post)
    {
        if ($post['topic_id'] == $topic_id)
        {
            $ids[] = $post['post_id'];
        }
    }
    
    $result_ids = array_slice($ids, $start, $limit);
    $post_list = array();
    foreach($result_ids as $pid)
    {
        $post = $posts[$pid];
        
        $attachment_list = array();
        if (!empty($post['attachments'])) {
            foreach($post['attachments'] as $attachment) {
                $attachment_list[] = new xmlrpcval(array(
                    'content_type'  => new xmlrpcval($attachment['content_type'], 'string'),
                    'thumbnail_url' => new xmlrpcval($attachment['thumbnail_url'], 'string'),
                    'url'           => new xmlrpcval($attachment['url'], 'string'),
                ), 'struct');
            }
        }
        
        $post_list[] = new xmlrpcval(array(
            'post_id'          => new xmlrpcval($pid, 'string'),
            'post_title'       => new xmlrpcval($post['post_title'], 'base64'),
            'post_content'     => new xmlrpcval($post['post_content'], 'base64'),
            'post_author_name' => new xmlrpcval($users[$post['author_id']]['user_name'], 'base64'),
    'post_author_display_name' => new xmlrpcval($users[$post['author_id']]['display_name'], 'base64'),
            'is_online'        => new xmlrpcval(in_array($post['author_id'], array_keys($online_user)), 'boolean'),
            'can_edit'         => new xmlrpcval($post['can_edit'], 'boolean'),
            'icon_url'         => new xmlrpcval($users[$post['author_id']]['icon_url'], 'string'),
            'post_time'        => new xmlrpcval(mobiquo_iso8601_encode($post['post_time']), 'dateTime.iso8601'),
            'attachments'      => new xmlrpcval($attachment_list, 'array'),
        ), 'struct');
    }

    $result = new xmlrpcval(array(
        'total_post_num'  => new xmlrpcval(count($ids), 'int'),
        'forum_id'        => new xmlrpcval($forum['forum_id'], 'string'),
        'forum_name'      => new xmlrpcval($forum['forum_name'], 'base64'),
        'topic_id'        => new xmlrpcval($topic_id, 'string'),
        'topic_title'     => new xmlrpcval($topic['topic_title'], 'base64'),
        'can_subscribe'   => new xmlrpcval($topic['can_subscribe'], 'boolean'),
        'is_subscribed'   => new xmlrpcval($topic['is_subscribed'], 'boolean'),
        'is_closed'       => new xmlrpcval($topic['is_closed'], 'boolean'),
        'can_reply'       => new xmlrpcval($topic['can_reply'], 'boolean'),
        'posts'           => new xmlrpcval($post_list, 'array'),
    ), 'struct');

    return new xmlrpcresp($result);
}
