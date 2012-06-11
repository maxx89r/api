<?php

defined('IN_MOBIQUO') or exit;

function login_forum_func($xmlrpc_params)
{
    $params = php_xmlrpc_decode($xmlrpc_params);

    $forum_id = $params[0];
    $password = $params[1];
    
    //check password here

    return xmlresptrue();
}
