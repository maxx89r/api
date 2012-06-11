<?php

defined('IN_MOBIQUO') or exit;

function get_quote_pm_func($xmlrpc_params)
{
    $params = php_xmlrpc_decode($xmlrpc_params);
    
    $message_id = $params[0];
    
    include('./test_data/data.php');
    
    if (!isset($messages[$message_id]))
        return xmlrespfalse("Message not exist!");
    
    $message = $messages[$message_id];
    // add quote message for pm
    $quote_title = "RE: " . $message['title'];
    $quote_content = "[quote]" . $message['content'] . "[/quote]\n";
    
    $response = new xmlrpcval(array(
        'result' => new xmlrpcval(true, 'boolean'),
        'msg_id'        => new xmlrpcval($message_id, 'string'),
        'msg_subject'   => new xmlrpcval($quote_title, 'base64'),
        'text_body'     => new xmlrpcval($quote_content, 'base64'),
    ), 'struct');

    return new xmlrpcresp($response);
}
