<?php

defined('IN_MOBIQUO') or exit;

function get_config_func()
{
    global $mobiquo_config;

    $config_list = array(
        'version'    => new xmlrpcval($mobiquo_config['version'], 'string'),
        'is_open'    => new xmlrpcval($mobiquo_config['is_open'], 'boolean'),
        'guest_okay' => new xmlrpcval($mobiquo_config['guest_okay'], 'boolean'),
        'reg_url'    => new xmlrpcval($mobiquo_config['reg_url'], 'string'),
        'api_level'      => new xmlrpcval($mobiquo_config['api_level'], 'string'),
        'disable_search' => new xmlrpcval($mobiquo_config['disable_search'], 'string'),
        'disable_latest' => new xmlrpcval($mobiquo_config['disable_latest'], 'string'),
        'disable_pm'     => new xmlrpcval($mobiquo_config['disable_pm'], 'string'),
        'disable_bbcode' => new xmlrpcval($mobiquo_config['disable_bbcode'], 'string'),
        'mark_forum'     => new xmlrpcval($mobiquo_config['mark_forum'], 'string'),
    );

    $response = new xmlrpcval($config_list, 'struct');

    return new xmlrpcresp($response);
}
