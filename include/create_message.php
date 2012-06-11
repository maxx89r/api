<?php

defined('IN_MOBIQUO') or exit;

function create_message_func($xmlrpc_params)
{
    $params = php_xmlrpc_decode($xmlrpc_params);

    $message_to = $params[0];
    $subject    = $params[1];
    $message    = $params[2];
    $action     = $params[3];
    $pm_id      = $params[4];
    
    // send message here
    
    return xmlresptrue();
}
