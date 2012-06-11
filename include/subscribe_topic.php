<?php

defined('IN_MOBIQUO') or exit;

function subscribe_topic_func($xmlrpc_params)
{
    $params = php_xmlrpc_decode($xmlrpc_params);

    $topic_id = $params[0];
    
    // do subscribe topic here

    return xmlresptrue();
}
