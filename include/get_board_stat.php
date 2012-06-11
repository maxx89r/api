<?php

defined('IN_MOBIQUO') or exit;

function get_board_stat_func() 
{
    include('./test_data/data.php');
    
    $board_stat = array(
        'total_threads' => new xmlrpcval($board_info['total_threads'], 'int'),
        'total_posts'   => new xmlrpcval($board_info['total_posts'], 'int'),
        'total_members' => new xmlrpcval($board_info['total_members'], 'int'),
        'guest_online'  => new xmlrpcval($board_info['guest_online'], 'int'),
        'total_online'  => new xmlrpcval($board_info['total_online'], 'int'),
    );
    
    $response = new xmlrpcval($board_stat, 'struct');
    
    return new xmlrpcresp($response);
}
