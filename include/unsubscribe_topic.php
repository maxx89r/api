<?php

defined('IN_MOBIQUO') or exit;

function unsubscribe_topic_func($xmlrpc_params)
{
    $params = php_xmlrpc_decode($xmlrpc_params);

    $topic_id = $params[0];
    
    // unsubscribe topic here

    return xmlresptrue();
}
