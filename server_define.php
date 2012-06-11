<?php

defined('IN_MOBIQUO') or exit;

$server_param = array(
    
    'login' => array(
        'function'  => 'login_func',
        'signature' => array(array($xmlrpcArray, $xmlrpcBase64, $xmlrpcBase64)),
        'docstring' => 'login need two parameters,the first is user name(Base64), second is password(Base64).',
    ),
    
    'get_forum' => array(
        'function'  => 'get_forum_func',
        'signature' => array(array($xmlrpcArray)),
        'docstring' => 'no need parameters for get_forum.',
    ),
    
    'get_board_stat' => array(
        'function'  => 'get_board_stat_func',
        'signature' => array(array($xmlrpcArray)),
        'docstring' => 'no need parameters for get_board_stat.',
    ),
    
    'get_topic' => array(
        'function'  => 'get_topic_func',
        'signature' => array(array($xmlrpcArray, $xmlrpcString, $xmlrpcInt, $xmlrpcInt, $xmlrpcString),
                             array($xmlrpcArray, $xmlrpcString, $xmlrpcInt, $xmlrpcInt),
                             array($xmlrpcArray, $xmlrpcString, $xmlrpcInt),
                             array($xmlrpcArray, $xmlrpcString)),
        'docstring' => 'parameter should be array(forum id(string), start topic num(int), end topic number(int), topic type(string, "TOP" for sticky topics, "ANN" for announcement topics)',
    ),
    
    'get_thread' => array(
        'function'  => 'get_thread_func',
        'signature' => array(array($xmlrpcArray, $xmlrpcString, $xmlrpcInt, $xmlrpcInt, $xmlrpcBoolean),
                             array($xmlrpcArray, $xmlrpcString, $xmlrpcInt, $xmlrpcInt),
                             array($xmlrpcArray, $xmlrpcString)),
        'docstring' => 'parameter should be array(topic id(string), start post number(int), end post number(int), bbcode enable(boolean))',
    ),
    
    'get_raw_post' => array(
        'function'  => 'get_raw_post_func',
        'signature' => array(array($xmlrpcArray, $xmlrpcString)),
        'docstring' => 'parameter should be array(post id(string))',
    ),
    
    'save_raw_post' => array(
        'function'  => 'save_raw_post_func',
        'signature' => array(array($xmlrpcArray, $xmlrpcString, $xmlrpcBase64, $xmlrpcBase64),
                             array($xmlrpcArray, $xmlrpcString, $xmlrpcBase64, $xmlrpcBase64, $xmlrpcBoolean)),
        'docstring' => 'parameter should be array(post id(string), post title(base64), post content(base64), bbcode enable(boolean))',
    ),
    
    'get_quote_post' => array(
        'function'  => 'get_quote_post_func',
        'signature' => array(array($xmlrpcArray, $xmlrpcString)),
        'docstring' => 'parameter should be array(post id(string))',
    ),
    
    'get_quote_pm' => array(
        'function'  => 'get_quote_pm_func',
        'signature' => array(array($xmlrpcArray, $xmlrpcString)),
        'docstring' => 'parameter should be array(pm id(string))',
    ),
    
    'get_user_topic' => array(
        'function'  => 'get_user_topic_func',
        'signature' => array(array($xmlrpcArray, $xmlrpcBase64)),
        'docstring' => 'parameter should be array(username(string))',
    ),
    
    'get_user_reply_post' => array(
        'function'  => 'get_user_reply_post_func',
        'signature' => array(array($xmlrpcArray, $xmlrpcBase64)),
        'docstring' => 'parameter should be array(username(string))',
    ),
    
    'get_new_topic' => array(
        'function'  => 'get_new_topic_func',
        'signature' => array(array($xmlrpcArray),
                             array($xmlrpcArray, $xmlrpcInt, $xmlrpcInt)),
        'docstring' => 'parameter should be array(start number(int), end bumber(int)) or no parameter',
    ),
    
    'get_latest_topic' => array(
        'function'  => 'get_latest_topic_func',
        'signature' => array(array($xmlrpcArray),
                             array($xmlrpcArray, $xmlrpcInt, $xmlrpcInt)),
        'docstring' => 'parameter should be array(start number(int), end bumber(int)) or no parameter',
    ),
    
    'get_unread_topic' => array(
        'function'  => 'get_unread_topic_func',
        'signature' => array(array($xmlrpcArray),
                             array($xmlrpcArray, $xmlrpcInt, $xmlrpcInt)),
        'docstring' => 'parameter should be array(start number(int), end bumber(int)) or no parameter',
    ),
        
    'get_subscribed_topic' => array(
        'function'  => 'get_subscribed_topic_func',
        'signature' => array(array($xmlrpcArray)),
        'docstring' => 'no need parameters for get_subscribed_topic, return first 20',
    ),
    
    'get_subscribed_forum' => array(
        'function'  => 'get_subscribed_forum_func',
        'signature' => array(array($xmlrpcArray)),
        'docstring' => 'no need parameters for get_subscribed_forum',
    ),
    
    'get_user_info' => array(
        'function'  => 'get_user_info_func',
        'signature' => array(array($xmlrpcArray, $xmlrpcBase64)),
        'docstring' => 'parameter should be array(username(string))',
    ),
    
    'get_config' => array(
        'function'  => 'get_config_func',
        'signature' => array(array($xmlrpcArray)),
        'docstring' => 'no need parameters for get_config',
    ),
    
    'logout_user' => array(
        'function'  => 'logout_user_func',
        'signature' => array(array($xmlrpcArray)),
        'docstring' => 'no need parameters for logout_user',
    ),
    
    'new_topic' => array(
        'function'  => 'new_topic_func',
        'signature' => array(array($xmlrpcArray, $xmlrpcString, $xmlrpcBase64, $xmlrpcBase64),
                             array($xmlrpcArray, $xmlrpcString, $xmlrpcBase64, $xmlrpcBase64, $xmlrpcString),
                             array($xmlrpcArray, $xmlrpcString, $xmlrpcBase64, $xmlrpcBase64, $xmlrpcString, $xmlrpcArray),
                             array($xmlrpcArray, $xmlrpcString, $xmlrpcBase64, $xmlrpcBase64, $xmlrpcString, $xmlrpcArray, $xmlrpcString)),
        'docstring' => 'parameter should be array(forum id(string), topic title(base64), topic content(base64), topic type id(string), attachments id(array), attachments group id(string))',
    ),
    
    'reply_post' => array(
        'function'  => 'reply_post_func',
        'signature' => array(array($xmlrpcArray, $xmlrpcString, $xmlrpcString, $xmlrpcBase64, $xmlrpcBase64),
                             array($xmlrpcArray, $xmlrpcString, $xmlrpcString, $xmlrpcBase64, $xmlrpcBase64, $xmlrpcArray, $xmlrpcString),
                             array($xmlrpcArray, $xmlrpcString, $xmlrpcString, $xmlrpcBase64, $xmlrpcBase64, $xmlrpcArray, $xmlrpcString, $xmlrpcBoolean)),
        'docstring' => 'parameter should be array(forum id(string), topic id(string), post title(base64), post content(base64), attachments id(array), attachment group id(string), bbcode enable(boolean))',
    ),
    
    'subscribe_topic' => array(
        'function'  => 'subscribe_topic_func',
        'signature' => array(array($xmlrpcArray, $xmlrpcString)),
        'docstring' => 'parameter should be array(topic id(string))',
    ),
    
    'unsubscribe_topic' => array(
        'function'  => 'unsubscribe_topic_func',
        'signature' => array(array($xmlrpcArray, $xmlrpcString)),
        'docstring' => 'parameter should be array(topic id(string))',
    ),
    
    'subscribe_forum' => array(
        'function'  => 'subscribe_forum_func',
        'signature' => array(array($xmlrpcArray, $xmlrpcString)),
        'docstring' => 'parameter should be array(forum id(string))',
    ),
    
    'unsubscribe_forum' => array(
        'function'  => 'unsubscribe_forum_func',
        'signature' => array(array($xmlrpcArray, $xmlrpcString)),
        'docstring' => 'parameter should be array(forum id(string))',
    ),
    
    'get_inbox_stat' => array(
        'function'  => 'get_inbox_stat_func',
        'signature' => array(array($xmlrpcArray)),
        'docstring' => 'no parameter for get_inbox_stat, but need login first',
    ),
    
    'get_box_info' => array(
        'function'  => 'get_box_info_func',
        'signature' => array(array($xmlrpcArray)),
        'docstring' => 'no parameter for get_inbox_stat, but need login first',
    ),
    
    'get_box' => array(
        'function'  => 'get_box_func',
        'signature' => array(array($xmlrpcArray, $xmlrpcString, $xmlrpcInt, $xmlrpcInt),
                             array($xmlrpcArray, $xmlrpcString)),
        'docstring' => 'parameter should be array(box id(string), start pm number(int), end pm number(int))',
    ),
    
    'get_message' => array(
        'function'  => 'get_message_func',
        'signature' => array(array($xmlrpcArray, $xmlrpcString),
                             array($xmlrpcArray, $xmlrpcString, $xmlrpcString),
                             array($xmlrpcArray, $xmlrpcString, $xmlrpcString, $xmlrpcBoolean)),
        'docstring' => 'parameter should be array(box id(string), pm id(string), bbcode enable(boolean))'
    ),
    
    'delete_message' => array(
        'function'  => 'delete_message_func',
        'signature' => array(array($xmlrpcArray, $xmlrpcString),
                             array($xmlrpcArray, $xmlrpcString, $xmlrpcString)),
        'docstring' => 'parameter should be array(box id(string), pm id(string))'
    ),
    
    'create_message' => array(
        'function'  => 'create_message_func',
        'signature' => array(array($xmlrpcArray, $xmlrpcArray, $xmlrpcBase64, $xmlrpcBase64),
                             array($xmlrpcArray, $xmlrpcArray, $xmlrpcBase64, $xmlrpcBase64, $xmlrpcInt, $xmlrpcString)),
        'docstring' => 'parameter should be array(pm to user list(array), pm title(string), pm content(string), pm type(int), original pm id(string))',
    ),
    
    'get_online_users' => array(
        'function'  => 'get_online_users_func',
        'signature' => array(array($xmlrpcArray)),
        'docstring' => 'no parameter',
    ),
    
    'mark_all_as_read' => array(
        'function'  => 'mark_all_as_read_func',
        'signature' => array(array($xmlrpcArray),
                             array($xmlrpcArray, $xmlrpcString)),
        'docstring' => 'parameter should be array(forum id(string)) or null',
    ),

    'search_topic' => array(
        'function'  => 'search_topic_func',
        'signature' => array(array($xmlrpcArray, $xmlrpcBase64, $xmlrpcInt, $xmlrpcInt, $xmlrpcString),
                             array($xmlrpcArray, $xmlrpcBase64, $xmlrpcInt, $xmlrpcInt),
                             array($xmlrpcArray, $xmlrpcBase64)),
        'docstring' => 'parameter should be array(search key words(base64),start number(int), end number(int), search id(string))',
    ),
    
    'search_post' => array(
        'function'  => 'search_post_func',
        'signature' => array(array($xmlrpcArray, $xmlrpcBase64, $xmlrpcInt, $xmlrpcInt, $xmlrpcString),
                             array($xmlrpcArray, $xmlrpcBase64, $xmlrpcInt, $xmlrpcInt),
                             array($xmlrpcArray, $xmlrpcBase64)),
        'docstring' => 'parameter should be array(search key words(base64),start number(int), end number(int), search id(string))',
    ),
    
    'get_participated_topic' => array(
        'function'  => 'get_participated_topic_func',
        'signature' => array(array($xmlrpcArray),
                             array($xmlrpcArray, $xmlrpcBase64),
                             array($xmlrpcArray, $xmlrpcInt, $xmlrpcInt),
                             array($xmlrpcArray, $xmlrpcBase64, $xmlrpcInt, $xmlrpcInt)),
        'docstring' => 'parameter should be array(username(base64), start number(int), end number(int))',
    ),
    
    'login_forum' => array(
        'function'  => 'login_forum_func',
        'signature' => array(array($xmlrpcArray, $xmlrpcString, $xmlrpcBase64)),
        'docstring' => 'parameter should be arrsy(forum id(string), password(base64))',
    ),
);
