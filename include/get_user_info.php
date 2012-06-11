<?php

defined('IN_MOBIQUO') or exit;

function get_user_info_func($xmlrpc_params)
{
    $params = php_xmlrpc_decode($xmlrpc_params);

    $username = $params[0];
    
    include('./test_data/data.php');
    
    $uid = $user_name_id[$username];
    if (!$uid || !isset($users[$uid])) 
        return xmlrespfalse("User '$username' is not exist!");
    
    $user_info = $users[$uid];
    
    $custom_fields = array(
        'age'   => 'Age',
        'msn'   => 'MSN',
    );
    
    $custom_fields_list = array();
    foreach($custom_fields as $key => $name) {
        $custom_fields_list[] = new xmlrpcval(array(
            'name'  => new xmlrpcval($name, 'base64'),
            'value' => new xmlrpcval($user_info[$key], 'base64')
        ), 'struct');
    }
    
    $xmlrpc_user_info = new xmlrpcval(array(
        'post_count'         => new xmlrpcval($user_info['post_count'], 'int'),
        'reg_time'           => new xmlrpcval(mobiquo_iso8601_encode($user_info['reg_time']), 'dateTime.iso8601'),
        'last_activity_time' => new xmlrpcval(mobiquo_iso8601_encode($user_info['last_activity_time']), 'dateTime.iso8601'),
        'icon_url'           => new xmlrpcval($user_info['icon_url'], 'string'),
        'display_name'       => new xmlrpcval($user_info['display_name'], 'base64'),
        'display_text'       => new xmlrpcval($user_info['display_text'], 'base64'),
        'is_online'          => new xmlrpcval(in_array($uid, array_keys($online_user)), 'boolean'),
        'accept_pm'          => new xmlrpcval($user_info['accept_pm'], 'boolean'),
        'custom_fields_list' => new xmlrpcval($custom_fields_list, 'array'),
    ), 'struct');

    return new xmlrpcresp($xmlrpc_user_info);
}
