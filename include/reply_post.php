<?php

defined('IN_MOBIQUO') or exit;

function reply_post_func($xmlrpc_params)
{
    $params = php_xmlrpc_decode($xmlrpc_params);

    $forum_id = $params[0];
    $topic_id = $params[1];
    $subject  = $params[2];
    $message  = $params[3];
    $attachment_ids  = $params[4];
    
    // post the new reply and get the new post id
    $pid = '123';
    $result = true;
    $action_message = '';
    // state value as 1 means it need approve before publishing
    $state = 0;
    
    $result = new xmlrpcval(array(
        'result'        => new xmlrpcval($result, 'boolean'),
        'result_text'   => new xmlrpcval($action_message, 'base64'),
        'post_id'       => new xmlrpcval($pid, 'string'),
        'state'         => new xmlrpcval($state, 'int'),
    ), 'struct');

    return new xmlrpcresp($result);
}
