<?php

define('IN_MOBIQUO', true);
define('FORUM_ROOT', 'http://'.$_SERVER['HTTP_HOST'].dirname(dirname($_SERVER['SCRIPT_NAME'])).'/');

error_reporting(0);
// uncomment below lines for debug
//error_reporting(-1);
//ini_set('display_errors', 1);

require('./lib/xmlrpc.inc');
require('./lib/xmlrpcs.inc');

include('./server_define.php');
include('./mobiquo_common.php');

$mobiquo_config = get_mobiquo_config();
$request_method_name = get_method_name();
if ($request_method_name && isset($server_param[$request_method_name]))
{
    // just for test, you may need more infor to decide the login status
    $is_login = !empty($_COOKIE['uid']);
    header('Mobiquo_is_login:' . $is_login ? 'true' : 'false');
    
    require('./include/'.$request_method_name.'.php');
}

$rpcServer = new xmlrpc_server($server_param, false);
$rpcServer->setDebug(1);
$rpcServer->compress_response = 'true';
$rpcServer->response_charset_encoding = 'UTF-8'; 

$response = $rpcServer->service();

?>