<?php

defined('IN_MOBIQUO') or exit;

function unsubscribe_forum_func($xmlrpc_params)
{
    $params = php_xmlrpc_decode($xmlrpc_params);

    $forum_id = $params[0];
    
    // unsubscribe forum here

    return xmlresptrue();
}
