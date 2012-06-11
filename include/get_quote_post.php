<?php

defined('IN_MOBIQUO') or exit;

function get_quote_post_func($xmlrpc_params)
{
    $params = php_xmlrpc_decode($xmlrpc_params);

    $post_id = $params[0];
    
    include('./test_data/data.php');
    
    if (!$post_id || !isset($posts[$post_id])) 
        return xmlrespfalse("Post id '$post_id' not exist!");
    
    $post = $posts[$post_id];
    // add quote message for post
    $quote_title = "RE: " . $post['post_title'];
    $quote_content = "[quote]" . $post['post_content'] . "[/quote]\n";
    
    $result = new xmlrpcval(array(
        'post_id'       => new xmlrpcval($post_id),
        'post_title'    => new xmlrpcval($quote_title, 'base64'),
        'post_content'  => new xmlrpcval($quote_content, 'base64'),
    ), 'struct');

    return new xmlrpcresp($result);
}
