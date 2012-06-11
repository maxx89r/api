<?php

defined('IN_MOBIQUO') or exit;

function save_raw_post_func($xmlrpc_params)
{
    $params = php_xmlrpc_decode($xmlrpc_params);

    $post_id      = $params[0];
    $post_title   = $params[1];
    $post_content = $params[2];
    
    // save post here and get the state
    $result = true;
    $action_message = '';
    $state = 0;
    
    $result = new xmlrpcval(array(
        'result'        => new xmlrpcval($result, 'boolean'),
        'result_text'   => new xmlrpcval($action_message, 'base64'),
        'state'         => new xmlrpcval($state, 'int'),
    ), 'struct');

    return new xmlrpcresp($result);
}
