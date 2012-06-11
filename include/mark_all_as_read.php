<?php

defined('IN_MOBIQUO') or exit;

function mark_all_as_read_func($xmlrpc_params)
{
    $params = php_xmlrpc_decode($xmlrpc_params);
    
    if (isset($params[0])) {
        $forum_id = $params[0];
        // mark single forum as read
    } else {
        // mark all forums as read
    }
    
    return xmlresptrue();
}
