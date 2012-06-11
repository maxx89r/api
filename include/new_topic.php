<?php

defined('IN_MOBIQUO') or exit;

function new_topic_func($xmlrpc_params)
{
    $params = php_xmlrpc_decode($xmlrpc_params);

    $forum_id = $params[0];
    $subject  = $params[1];
    $message  = $params[2];
    $prefix_id  = $params[3];
    $attachment_ids  = $params[4];
    
    // post the new topic and get the new topic id
    $tid = '123';
    $result = true;
    $action_message = '';
    // state value as 1 means it need approve before publishing
    $state = 0;

    $result = new xmlrpcval(array(
        'result'        => new xmlrpcval($result, 'boolean'),
        'result_text'   => new xmlrpcval($action_message, 'base64'),
        'topic_id'      => new xmlrpcval($tid, 'string'),
        'state'         => new xmlrpcval($state, 'int'),
    ), 'struct');

    return new xmlrpcresp($result);
}
